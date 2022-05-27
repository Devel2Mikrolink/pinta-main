<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Inertia::render('Admin');
    }

    public function about(){
        $dividendo = 100;
        $divisor = 6;
        /*DB::statement(DB::raw('CALL DIV_DOUBLE(?, ?, @producto)'),
            array($dividendo, $divisor)
        );

        $result = DB::select('SELECT @producto AS producto');*/

        $result = DB::select(DB::raw('CALL APLICA_ENTRADA_IN(?)'),
            array(13399874)
        );


        return $result;
    }
}
