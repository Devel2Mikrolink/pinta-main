<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard');
    }

    public function about()
    {
        return Inertia::render('About', [
            'hello' => "hello world",
        ]);
    }
}
