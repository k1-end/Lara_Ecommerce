<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::simplePaginate(15);
        // if (auth()->check() && auth()->user()->hasPermissionTo('EditProducts')) {
        //     return view('dashboard.products')->with('products' , $products);
        // }
        return view('home')->with('products' , $products);
    }

    public function dashboard_index()
    {
        $products = Product::simplePaginate(15);
        $this->authorize('viewAny' , Product::class);
        return view('dashboard.products')->with('products' , $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create' , Product::class);
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
        $this->authorize('create' , Product::class);
        $request->validate([
            'category' => ['required'],
            'brand' => ['required' ],
            'price' => ['required' ],
            'desc' => ['required' ],
            'name' => ['required' , 'unique:products'],
            'image' => ['required' , 'mimes:png,jpg,jpeg' , 'max:2048' , new \App\Rules\Image1000]
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->category = $request->category;
        $image = Image::make($request->file('image'));
        $image->heighten(1000);
        $image->save();
        $product->image = $request->file('image')->store('public/photos');
        $image->resize(300 , 300)->save();
        $product->thumbnail = $request->file('image')->store('public/photos/300');
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
        if (auth()->check() && auth()->user()->can('viewAny' , Product::class)) {
            return view('dashboard.product')->with('product' , $product);
        }
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
        $this->authorize('update', $product);
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
        $this->authorize('update', $product);
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
        $this->authorize('delete', $product);
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
        $this->authorize('update', $cart);
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
        $products = Product::where('name' , 'like' , '%'.$request->input('query'). '%')->select('name' , 'id')->get();
        return view('search')->with([
            'products' => $products , 
            'query' => $request->input('query')
        ]);
    }
}
