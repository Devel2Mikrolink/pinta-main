<?php

namespace App\Http\Controllers\Catalogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    public function index()
    {
        return Inertia::render('Catalogs/Index');
    }

    public function about()
    {
        return Inertia::render('About', [
            'hello' => "hello world",
        ]);
    }

}
