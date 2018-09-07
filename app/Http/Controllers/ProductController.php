<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function add()
    {
        return view('product.create');
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
