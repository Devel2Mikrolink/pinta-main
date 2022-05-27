<?php

namespace App\Http\Controllers\Catalogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return Inertia::render('Catalogs/Categories/Index')->with(compact('categories'));
    }

    public function create()
    {
        return Inertia::render('Catalogs/Categories/Create');
    }

    public function store(Request $request)
    {
        Category::create(
            $request->validate(
                [
                    'title' => ['required', 'max:50'],
                    'description' => ['required', 'max:50']                    
                ]
            )
        );

        return Redirect::route('catalogs.categories.index');
    }

    public function show($id)
    {
        $category = Category::find($id);

        return Inertia::render('Catalogs/Categories/Show', ['category' => $category]);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return Inertia::render('Catalogs/Categories/Edit', ['category' => $category]);
    }

    public function update(Request $request)
    {
        Category::where('is_active', 1)
            ->where('id', $request->id)
            ->update($request->validate(
                [
                    'id' => ['required'],
                    'title' => ['required', 'min:1', 'max:50'],
                    'description' => ['required',  'max:50'],
                    'local_image_url' => ['required',  'max:50'],
                    'web_image_url' => ['required',  'max:50'],
                    'firestore_reference' => ['required', 'min:1', 'max:50'],
                ]
            ));

        return Redirect::route('catalogs.categories.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->is_active = !$category->is_active;
        $category->save();
        
        return Redirect::route('catalogs.categories.index');
    }
}
