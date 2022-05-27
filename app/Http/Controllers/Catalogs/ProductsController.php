<?php

namespace App\Http\Controllers\Catalogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Supply;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return Inertia::render('Catalogs/Products/Index')->with(compact('products'));
    }


    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        $supplies = Supply::with('measure')->where('is_active', 1)->get();

        return Inertia::render('Catalogs/Products/Create')->with(compact('categories', 'supplies'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->available = $request->available;
        $product->id_category = $request->id_category;
        $product->is_active = true;
        $product->save();
        
        foreach($request->components as $product_component)
        {
         
            $component = new ProductDetail();
            $component->id_product = $product['id'];
            $component->id_supply = $product_component['supply']['id'];
            $component->quantity = $product_component['quantity'];
            $component->is_active= 1;
            $component->save();
        }
        return redirect('admin/catalogs/products');
    }
}
