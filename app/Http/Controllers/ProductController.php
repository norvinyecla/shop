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

    public function save(Request $request, Product $product)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|integer',
                'picture' => 'required|mimes:jpg,jpeg,gif,png'
            ]
        );

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

    public function add(Request $request)
    {
        return $this->save($request, new Product);
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        return $this->save($request, $product);
    }

    public function delete(int $id)
    {
        return view('product.list');
    }
}
