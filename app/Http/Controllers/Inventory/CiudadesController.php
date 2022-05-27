<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Pais;
use App\Models\Ciudad;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CiudadesExport;
use Barryvdh\DomPDF\Facade as PDF;
class CiudadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::select('CIUDAD_ID', 'NOMBRE','is_active')->get();
        
        $estados = Estado::select('ESTADO_ID', 'NOMBRE')->where('is_active',1)->get();
        return Inertia::render('Inventory/Ciudades/Index')->with(compact('ciudades','estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $guardarciudad = new Ciudad();
        $guardarciudad->NOMBRE = $request->NOMBRE;
        $guardarciudad->CLAVE_FISCAL=$request->CLAVE_FISCAL;
        $guardarciudad->ESTADO_ID=$request->ESTADO_ID;
        if($request->ES_PREDET == true)
        {
            $guardarciudad->ES_PREDET='S';
        }
        $guardarciudad->FECHA_HORA_CREACION=Carbon::now();
        $guardarciudad->FECHA_HORA_ULT_MODIF=Carbon::now();
        $guardarciudad->save();
        return Redirect::route('ciudades.index');
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
    public function update(Request $request)
    {

      
        $update = Ciudad::where('CIUDAD_ID','=',$request->CIUDAD_ID)->first();

        $update->NOMBRE = $request->NOMBRE;
        $update->CLAVE_FISCAL = $request->CLAVE_FISCAL;
        $update->ESTADO_ID = $request->ESTADO_ID;
       
        if($request->check == true)
        {
            $update->ES_PREDET = 'S';
        }
        $update->FECHA_HORA_ULT_MODIF=Carbon::now();
        
        $update->save();
        return Redirect::route('ciudades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($CIUDAD_ID)
    {
        $getServices =Ciudad::where('CIUDAD_ID','=',$CIUDAD_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('ciudades.index');
    }


    public function export(Request $request) 
    {
        
        
        return Excel::download(new CiudadesExport($request), 'Ciudades.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $ciudades = Ciudad::find($request);

              
        $pdf = PDF::loadView('pdf.ciudades', compact('ciudades'));
       
        return $pdf->stream();

        

    }
}
