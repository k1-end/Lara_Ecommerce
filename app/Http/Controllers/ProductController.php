<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        if (auth()->check() && auth()->user()->hasPermissionTo('EditProducts')) {
            return view('dashboard.products')->with('products' , $products);
        }
        return view('home')->with('products' , $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.new_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'brand' => ['required' ],
            'price' => ['required' ],
            'desc' => ['required' ],
            'name' =>['required' , 'unique:products']
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->category = $request->category;
        $product->thumbnail = '';
        $product->save();
        return redirect('/dashboard/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product')->with('product' , $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view ('dashboard.product')->with('product' , $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category' => ['required'],
            'brand' => ['required' ],
            'price' => ['required' ],
            'desc' => ['required' ],
            'name' =>['required']
        ]);
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->category = $request->category;
        $product->save();
        return redirect('/dashboard/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/dashboard/products');
    }

    public function add_to_cart(Product $product)
    {
        $cart = Cart::firstOrNew(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ] , [
                'order_id' => null,
                'quantity' => 0
            ]);
        
        
        $cart->quantity += 1;
        
        $cart->save();
        
        return redirect()->route('product' , ['product' => $product]);
    }
    
    function cart_page(Request $request) 
    {
        $carts = Cart::where('user_id' , auth()->id())->get();
        return view('cart')->with('carts' , $carts);
    }

    public function search(Request $request)
    {
        // return $request->input('query');
        $products = Product::where('name' , 'like' , '%'.$request->input('query'). '%')->select('name' , 'id')->get();
        //return $products;
        return view('search')->with([
            'products' => $products , 
            'query' => $request->input('query')
        ]);
    }
}
