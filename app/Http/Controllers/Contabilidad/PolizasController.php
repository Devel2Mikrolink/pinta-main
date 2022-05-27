<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TipoPoliza;
use App\Models\Moneda;
use App\Models\Cuentaco;
use Carbon\Carbon;
use App\Models\Poliza;

class PolizasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polizas=Poliza::all();
     

        return Inertia::render('Contabilidad/Polizas/Index')->with(compact('polizas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tipospolizas=TipoPoliza::select('is_active','TIPO_POLIZA_ID','NOMBRE')->where('is_active',1)->get();
        $monedas=Moneda::select('is_active','MONEDA_ID','NOMBRE')->where('is_active',1)->get();
        $cuentacos=Cuentaco::select('is_active','CUENTA_PT','NOMBRE','CUENTA_ID')->where('is_active',1)->get();
        return Inertia::render('Contabilidad/Polizas/Create')->with(compact('tipospolizas','monedas','cuentacos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
