<?php

namespace App\Http\Controllers\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CuentaBancaria;
use App\Models\Banco;
use App\Models\Moneda;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlmacenesExport;
use Barryvdh\DomPDF\Facade as PDF;

class CuentasBancariasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    se crea una variable llamada cuentasbancarias lo que significa que del modelo cuentabancaria se va a extraer los datos
    //      se debe de declarar en la parte de arriba ademas lo que se utiliza es eloquent 
         
        $cuentasbancarias = CuentaBancaria::select('CUENTA_BAN_ID', 'NOMBRE','is_active')->get();
         /**en la parte del return retorna la vista que en realidad es una ruta que se declaro en el web.php y con el with se 
  * le especifica que se mande con esa variable
  */
  return Inertia::render('Contabilidad/CuentasBancarias/Index')->with(compact('cuentasbancarias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $bancos=BANCO::select('BANCO_ID', 'NOMBRE')->where('is_active','=',1)->get();
        $monedas=MONEDA::select('MONEDA_ID', 'NOMBRE')->where('is_active','=',1)->get();
        
       
        return Inertia::render('Contabilidad/CuentasBancarias/Create')->with(compact('bancos','monedas'));
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
