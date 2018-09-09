<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;

class ProductController extends Controller
{
    public function index() 
    {
        return view('product.index');
    }

    public function details(int $id)
    {
        return view('product.details');
    }

    public function create()
    {
        return view('product.create');
    }
    
    public function edit(int $id)
    {
        return view('product.edit');
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|integer',
                'picture' => 'required|mimes:jpg,jpeg,gif,png'
            ]
        );

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('picture')) {
            $path = $request->picture->store('uploads');
            $product->picture = $path;
        }

        $product->save();
        return response()->json($product);        
    }

    public function update(int $id)
    {
        return view('product.edit');
    }

    public function delete(int $id)
    {
        return view('product.list');
    }
}
