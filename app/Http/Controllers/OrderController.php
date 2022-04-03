<?php

namespace App\Http\Controllers;
use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\ClientException;
use \GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function order_page(Request $request) 
    {
        $user = auth()->user();
        $user_cart = $user->cart;
        $products = Product::findMany($user_cart->pluck('product_id'));
        return view('order')->with('carts' , $user_cart);
    }

    private function get_checkout_response($order_id , $amount)
    {
        $client = new Client();
        try {
            $res = $client->request('POST' , 'https://api.idpay.ir/v1.1/payment' , [
                'json'=>[
                    'order_id' => $order_id,
                    'amount' => $amount,
                    'callback' => route('callback')
                ],
                'headers'=>[
                    'X-API-KEY' => '423316bf-4e39-4339-993d-6c217b9e9719',
                    'X-SANDBOX' => '1'
                ]]);
        } catch (ClientException $e) {
            return  Psr7\Message::toString($e->getRequest()) . Psr7\Message::toString($e->getResponse());
        }
        if ($res->getStatusCode() == "201") {
            return json_decode($res->getBody() , true);
        }else {
            return "";
        }
    }

    function checkout(Request $request)
    {
        $request->validate([
            'address' => ['required']
        ]);
        
        
        $user = auth()->user();
        $user_cart = $user->cart;
        // $products = Product::findMany($user_cart->pluck('product_id'));
        $order = new Order;
        $order->user_id = auth()->id();
        $order->amount = $this->calc_sum($user_cart);
        $order->status = -1;
        $order->test = true;
        $order->shipping_addr = $request->address;
        $order->date = date("Y-m-d");
        $order->save();
        foreach ($user_cart as $cart ) {
            $cart->order_id = $order->id;
            $cart->save();
        }
        $response = $this->get_checkout_response($order->id , $order->amount);
        $order->response_link = $response['link'];
        $order->response_id = $response['id'];
        // TODO: set date according to the api response
        
        
        $order->save();
        return redirect($order->response_link);
    }

    private function calc_sum($carts)
    {
        $sum = 0;
        foreach ($carts as $cart ) {
            $sum += $cart->product->price * $cart->quantity;
        }
        return $sum;
        
    }

    public function callback(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->track_id = $request->track_id;
        // TODO: check response id and amount
        $order->card_no = $request->card_no;
        $order->save();
        if ($order->status == 10) {
            $response = $this->confirm_order($order->response_id , $order->id);
            $this->clear_cart($order->id);
            return view('PaymentResult')->with('result', true);
        }else {
            return view('PaymentResult')->with('result', false);
        }
    }

    private function confirm_order($response_id , $order_id)
    {
        $client = new Client();
        try {
            $res = $client->request('POST' , 'https://api.idpay.ir/v1.1/payment/verify' , [
                'json'=>[
                    'order_id' => $order_id,
                    'id' => $response_id
                ],
                'headers'=>[
                    'X-API-KEY' => '423316bf-4e39-4339-993d-6c217b9e9719',
                    'X-SANDBOX' => '1'
                ]]);
        } catch (ClientException $e) {
            return  Psr7\Message::toString($e->getRequest()) . Psr7\Message::toString($e->getResponse());
        }
        if ($res->getStatusCode() == "200") {
            return json_decode($res->getBody() , true);
        }else {
            return "";
        }
    }

    private function clear_cart($order_id)
    {
        $carts = Cart::where('order_id' , $order_id)->get();
        foreach ($carts as $cart ) {
            $cart->delete();
        }
    }
}
