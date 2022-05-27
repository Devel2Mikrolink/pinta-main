<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\LugarExpedicion;
use App\Models\Ciudad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LugaresexpedicionExport;
use Barryvdh\DomPDF\Facade as PDF;



class LugaresExpedicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         /**se crea una variable llamada paises lo que significa que del modelo pais se va a extraer todoo el modelo del pais 
         * se debe de declarar en la parte de arriba ademas lo que se utiliza es eloquent 
         */
        $lugaresExpedicion = LugarExpedicion::select('LUGAR_EXPEDICION_ID', 'NOMBRE', 'is_active')->get();
        
   
       
        
 /**en la parte del return retorna la vista que en realidad es una ruta que se declaro en el web.php y con el with se 
  * le especifica que se mande con esa variable
  */
        return Inertia::render('Inventory/LugarExpedicion/Index')->with(compact('lugaresExpedicion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudades=Ciudad::select('CIUDAD_ID', 'NOMBRE')->where('is_active',1)->get();
        return Inertia::render('Inventory/LugarExpedicion/Create')->with(compact('ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guardarLugarExpedicion = new LugarExpedicion();
        $guardarLugarExpedicion->NOMBRE = $request->NOMBRE;
        $guardarLugarExpedicion->ZONA_HORARIA = $request->ZONA_HORARIA;
        $guardarLugarExpedicion->CALLE=$request->CALLE;
        $guardarLugarExpedicion->NUM_EXTERIOR=$request->NUM_EXTERIOR;
        $guardarLugarExpedicion->NUM_INTERIOR=$request->NUM_INTERIOR;
        $guardarLugarExpedicion->COLONIA=$request->COLONIA;
        $guardarLugarExpedicion->COLONIA_CLAVE_FISCAL=$request->COLONIA_CLAVE_FISCAL;
        $guardarLugarExpedicion->POBLACION=$request->POBLACION;
        $guardarLugarExpedicion->POBLACION_CLAVE_FISCAL=$request->POBLACION_CLAVE_FISCAL;
        $guardarLugarExpedicion->REFERENCIA=$request->REFERENCIA;
        $guardarLugarExpedicion->CIUDAD_ID=$request->CIUDAD_ID;
        $guardarLugarExpedicion->CODIGO_POSTAL=$request->CODIGO_POSTAL;
        $guardarLugarExpedicion->FECHA_HORA_CREACION=Carbon::now();
        $guardarLugarExpedicion->FECHA_HORA_ULT_MODIF=Carbon::now();
        $guardarLugarExpedicion->save();
        return Redirect::route('lugaresExpedicion.index');
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
        $lugaresexpedicion = LugarExpedicion::find($id);

        return Inertia::render('Inventory/LugarExpedicion/Edit', ['lugaresexpedicion' => $lugaresexpedicion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        $guardarLugarExpedicion = LugarExpedicion::where('LUGAR_EXPEDICION_ID','=',$request->LUGAR_EXPEDICION_ID)->first();

        $guardarLugarExpedicion->NOMBRE = $request->NOMBRE;
        $guardarLugarExpedicion->ZONA_HORARIA = $request->ZONA_HORARIA;
        $guardarLugarExpedicion->CALLE=$request->CALLE;
        $guardarLugarExpedicion->NUM_EXTERIOR=$request->NUM_EXTERIOR;
        $guardarLugarExpedicion->NUM_INTERIOR=$request->NUM_INTERIOR;
        $guardarLugarExpedicion->COLONIA=$request->COLONIA;
        $guardarLugarExpedicion->COLONIA_CLAVE_FISCAL=$request->COLONIA_CLAVE_FISCAL;
        $guardarLugarExpedicion->POBLACION=$request->POBLACION;
        $guardarLugarExpedicion->POBLACION_CLAVE_FISCAL=$request->POBLACION_CLAVE_FISCAL;
        $guardarLugarExpedicion->REFERENCIA=$request->REFERENCIA;
        $guardarLugarExpedicion->CIUDAD_ID=$request->CIUDAD_ID;
        $guardarLugarExpedicion->CODIGO_POSTAL=$request->CODIGO_POSTAL;
        $guardarLugarExpedicion->FECHA_HORA_CREACION=Carbon::now();
        $guardarLugarExpedicion->FECHA_HORA_ULT_MODIF=Carbon::now();
        $guardarLugarExpedicion->save();
        return Redirect::route('lugaresExpedicion.index');
        
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

    public function export(Request $request) 
    {
        
        
        
        return Excel::download(new LugaresexpedicionExport($request), 'LugaresExpedicion.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $lugaresexpedicion = LugarExpedicion::find($request);

              
        $pdf = PDF::loadView('pdf.lugaresexpedicion', compact('lugaresexpedicion'));
       
        return $pdf->stream();

    }
}
