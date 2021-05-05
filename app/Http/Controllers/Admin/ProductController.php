<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.addProductForm');
    }
    public function store(Request $request)
    {
        $img = $request
            -> file('img')
            -> store('products');

        $data = $request -> input();
        $data['img'] = $img;
        Product::create($data);
        return back();
    }

}
