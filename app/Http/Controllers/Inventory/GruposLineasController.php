<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\GrupoLinea;
use App\Models\Cuentaco;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GruposLineasExport;
use Barryvdh\DomPDF\Facade as PDF;



class GruposLineasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datasave = request()->datasave;

        if($datasave  ){
       
            $gruposlineas = GrupoLinea::select('GRUPO_LINEA_ID', 'NOMBRE','is_active')->get();
            return Inertia::render('Inventory/GruposLineas/Index')->with(compact('gruposlineas'));
           
        }
        else{
            $gruposlineas = GrupoLinea::select('GRUPO_LINEA_ID','OCULTO', 'NOMBRE','is_active')->where('OCULTO','N')->get();
            return Inertia::render('Inventory/GruposLineas/Index')->with(compact('gruposlineas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentasco=Cuentaco::select('CUENTA_ID', 'NOMBRE','SUBCUENTA')->where('is_active','=',1)->get();
        return Inertia::render('Inventory/GruposLineas/Create')->with(compact('cuentasco'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     
        $guardar = new GrupoLinea();
        $guardar->NOMBRE= $request->NOMBRE;
       
        if($request->APLICAR_FACTOR_VENTA == true)
        {
            $guardar->APLICAR_FACTOR_VENTA='S';
        }
        if($request->FACTOR_VENTA == null)
        {
            $guardar->FACTOR_VENTA=0;
        }else{
            $guardar->FACTOR_VENTA=$request->FACTOR_VENTA;
        }
        
        $guardar->ES_PREDET = $request->ES_PREDET == true ? 'S' : 'N';
        $guardar->OCULTO = $request->OCULTO == true ? 'S' : 'N';
        $guardar->FECHA_HORA_CREACION=Carbon::now();
        $guardar->FECHA_HORA_ULT_MODIF=Carbon::now();   
        
        
        $guardar->CUENTA_ALMACEN = $request->CUENTA_ALMACEN;
        $guardar->CUENTA_COSTO_VENTA = $request->CUENTA_COSTO_VENTA;
        $guardar->CUENTA_COMPRAS = $request->CUENTA_COMPRAS;
        $guardar->CUENTA_DEVOL_COMPRAS = $request->CUENTA_DEVOL_COMPRAS;
        $guardar->CUENTA_VENTAS = $request->CUENTA_VENTAS;
        $guardar->CUENTA_DEVOL_VENTAS = $request->CUENTA_DEVOL_VENTAS;
        
        $guardar->save();

        if($request->CREATEORCLOSE == 2)
        {
            return Redirect::route('gruposlineas.create'); 
        }
        else{
            return Redirect::route('gruposlineas.index');

        }

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
    {$grupolinea = GrupoLinea::find($id);
        $cuentasco=Cuentaco::select('CUENTA_ID', 'NOMBRE','SUBCUENTA')->where('is_active','=',1)->get();
        $grupolinea->ES_PREDET = $grupolinea->ES_PREDET == 'S' ? true : false;
        $grupolinea->OCULTO  = $grupolinea->OCULTO == 'S' ? true : false;
        $grupolinea->APLICAR_FACTOR_VENTA  = $grupolinea->APLICAR_FACTOR_VENTA == 'S' ? true : false;
        return Inertia::render('Inventory/GruposLineas/Edit', ['grupolinea' => $grupolinea,'cuentasco'=>$cuentasco]);
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

     
        
        $guardar = GrupoLinea::where('GRUPO_LINEA_ID','=',$request->GRUPO_LINEA_ID)->first();

        $guardar->NOMBRE= $request->NOMBRE;
       
        if($request->APLICAR_FACTOR_VENTA == true)
        {
            $guardar->APLICAR_FACTOR_VENTA='S';
        }
        $guardar->FACTOR_VENTA=$request->FACTOR_VENTA;
  
        $guardar->FECHA_HORA_ULT_MODIF=Carbon::now();
        $guardar->ES_PREDET = $request->ES_PREDET == true || 'S' ? 'S' : 'N';
        $guardar->OCULTO = $request->OCULTO == true || 'S' ? 'S' : 'N';
        $guardar->CUENTA_ALMACEN = $request->CUENTA_ALMACEN;
        $guardar->CUENTA_COSTO_VENTA = $request->CUENTA_COSTO_VENTA;
        $guardar->CUENTA_COMPRAS = $request->CUENTA_COMPRAS;
        $guardar->CUENTA_DEVOL_COMPRAS = $request->CUENTA_DEVOL_COMPRAS;
        $guardar->CUENTA_VENTAS = $request->CUENTA_VENTAS;
        $guardar->CUENTA_DEVOL_VENTAS = $request->CUENTA_DEVOL_VENTAS;
        $guardar->save();

        if($id == 2)
        {
            return Redirect::route('gruposlineas.create'); 
        }
        else{
            return Redirect::route('gruposlineas.index');

        }


    }

    
    public function destroy($GRUPO_LINEA_ID)
    {
        $getServices =GrupoLinea::where('GRUPO_LINEA_ID','=',$GRUPO_LINEA_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('gruposlineas.index');
    }

    public function export(Request $request) 
    {
        
        
        return Excel::download(new GruposLineasExport($request), 'GrupoLineas.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $gruposlineas = GrupoLinea::find($request);

              
        $pdf = PDF::loadView('pdf.gruposlineas', compact('gruposlineas'));
       
        return $pdf->stream();

    }
}
