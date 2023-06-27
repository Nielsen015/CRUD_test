<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::latest()->paginate(3);
        return view ('products/index', compact('products'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //validate input
         $request->validate([
            'name' => 'required',
            'detail' => 'required'
         ]);

        //  create product in the database
        Product::create($request->all());

        // redirect user and send a friendly messsage
        return redirect() ->route('products.index')->with('success', 'Product Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //show products
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //edi tproduct
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //update changes in database
         //validate input
         $request->validate([
            'name' => 'required',
            'detail' => 'required'
         ]);

        //  create product in the database
        $product->update($request->all());

        // redirect user and send a friendly messsage
        return redirect() ->route('products.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //delete a product
        $product->delete();
        // success message
        return redirect()->route('products.index')->with('success', 'producted deleted successfully');
    }
}
