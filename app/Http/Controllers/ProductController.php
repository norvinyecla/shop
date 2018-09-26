<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function home() 
    {
        return view('product.index');
    }

    public function index(Request $request) 
    {
        $sortBy = $request->input('sort_by') ?? 'id';
        $sortDirection = $request->input('order') ?? 'asc';
        
        $products = DB::table('products')->orderBy($sortBy, $sortDirection)
            ->paginate(25);
        return response()->json($products);
    }

    public function details(int $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function view(int $id)
    {
        $product = Product::findOrFail($id);
        return view(
            'product.details', [
                'product' => $product 
            ]
        );
    }


    public function create()
    {
        return view('product.create');
    }
    
    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        return view(
            'product.edit', [
                'product' => $product 
            ]
        );
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
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(["message" => "Product {$id} has been deleted."]);
    }
}
