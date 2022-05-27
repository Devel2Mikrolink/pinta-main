<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Almacen;
use App\Models\Ciudad;
use App\Models\Cuentaco;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlmacenesExport;
use Barryvdh\DomPDF\Facade as PDF;


class AlmacenesController extends Controller
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
            $almacenes = Almacen::with('relacion_ciudad')->select('ALMACEN_ID','NOMBRE','CIUDAD_ID','is_active')->get();
            return Inertia::render('Inventory/Almacenes/Index')->with(compact('almacenes'));
           
        }
        else{
            $almacenes = Almacen::with('relacion_ciudad')->select('ALMACEN_ID','NOMBRE','CIUDAD_ID','is_active')->where('OCULTO','N')->get();
            
            return Inertia::render('Inventory/Almacenes/Index')->with(compact('almacenes'));
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
        $ciudades =Ciudad::select('CIUDAD_ID','NOMBRE')->where('is_active','=',1)->get();
        return Inertia::render('Inventory/Almacenes/Create')->with(compact('cuentasco','ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        
        $guardar = new Almacen();
        $guardar->NOMBRE = $request->NOMBRE;
        $guardar->NOMBRE_ABREV = $request->NOMBRE_ABREV;
        $guardar->CALLE = $request->CALLE;
        $guardar->NUM_EXTERIOR = $request->NUM_EXTERIOR;
        $guardar->NUM_INTERIOR = $request->NUM_INTERIOR;
        $guardar->COLONIA = $request->COLONIA;
        $guardar->POBLACION = $request->POBLACION;
        $guardar->REFERENCIA = $request->REFERENCIA;
        $guardar->CIUDAD_ID = $request->CIUDAD_ID;
        $guardar->CODIGO_POSTAL = $request->CODIGO_POSTAL;
        $guardar->TELEFONO1 = $request->TELEFONO1;
        $guardar->TELEFONO2 = $request->TELEFONO2;
        $guardar->CUENTA_ALMACEN= $request->CUENTA_ALMACEN;
        $guardar->CUENTA_COSTO_VENTA= $request->CUENTA_COSTO_VENTA;
        $guardar->CUENTA_VENTAS=$request->CUENTA_VENTAS;
        $guardar->CUENTA_DEVOL_VENTAS = $request->CUENTA_DEVOL_VENTAS;
        $guardar->CUENTA_COMPRAS= $request->CUENTA_COMPRAS;
        $guardar->CUENTA_DEVOL_COMPRAS= $request->CUENTA_DEVOL_COMPRAS;
        $guardar->ES_PREDET = $request->ES_PREDET == true ? 'S' : 'N';
        $guardar->OCULTO = $request->OCULTO == true ? 'S' : 'N';
        $guardar->FECHA_HORA_CREACION=Carbon::now();
        $guardar->FECHA_HORA_ULT_MODIF=Carbon::now();
     
        $guardar->save();

        
        if($id == 2)
        {
            return Redirect::route('almacenes.create'); 
        }
        else{
            return Redirect::route('almacenes.index');

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
    {

        $cuentasco=Cuentaco::select('CUENTA_ID', 'NOMBRE','SUBCUENTA')->where('is_active','=',1)->get();
        $ciudades =Ciudad::select('CIUDAD_ID','NOMBRE')->where('is_active','=',1)->get();
        
        $almacen = Almacen::with('relacion_ciudad')->find($id);
        $almacen->ES_PREDET = $almacen->ES_PREDET == 'S' ? true : false;
        $almacen->OCULTO  = $almacen->OCULTO == 'S' ? true : false;
        
    
        
        return Inertia::render('Inventory/Almacenes/Edit', ['almacen' => $almacen, 'ciudades' => $ciudades, 'cuentasco' => $cuentasco]);
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
        
        $guardar = Almacen::where('ALMACEN_ID','=',$request->ALMACEN_ID)->first();



        $guardar->NOMBRE = $request->NOMBRE;
        $guardar->NOMBRE_ABREV = $request->NOMBRE_ABREV;
        $guardar->CALLE = $request->CALLE;
        $guardar->NUM_EXTERIOR = $request->NUM_EXTERIOR;
        $guardar->NUM_INTERIOR = $request->NUM_INTERIOR;
        $guardar->COLONIA = $request->COLONIA;
        $guardar->POBLACION = $request->POBLACION;
        $guardar->REFERENCIA = $request->REFERENCIA;
        $guardar->CIUDAD_ID = $request->CIUDAD_ID;
        $guardar->CODIGO_POSTAL = $request->CODIGO_POSTAL;
        $guardar->TELEFONO1 = $request->TELEFONO1;
        $guardar->TELEFONO2 = $request->TELEFONO2;
        $guardar->ES_PREDET = $request->ES_PREDET == true ? 'S' : 'N';
        $guardar->OCULTO = $request->OCULTO == true ? 'S' : 'N';
        $guardar->CUENTA_ALMACEN= $request->CUENTA_ALMACEN;
        $guardar->CUENTA_COSTO_VENTA= $request->CUENTA_COSTO_VENTA;
        $guardar->CUENTA_VENTAS=$request->CUENTA_VENTAS;
        $guardar->CUENTA_DEVOL_VENTAS = $request->CUENTA_DEVOL_VENTAS;
        $guardar->CUENTA_COMPRAS= $request->CUENTA_COMPRAS;
        $guardar->CUENTA_DEVOL_COMPRAS= $request->CUENTA_DEVOL_COMPRAS;
        $guardar->FECHA_HORA_CREACION=Carbon::now();
        $guardar->FECHA_HORA_ULT_MODIF=Carbon::now();
     
        
        $guardar->save();

        if($id == 2)
        {
            return Redirect::route('almacenes.create'); 
        }
        else{
            return Redirect::route('almacenes.index');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ALMACEN_ID)
    {
        $getServices =Almacen::where('ALMACEN_ID','=',$ALMACEN_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('almacenes.index');
    }



    public function export(Request $request) 
    {
        
        
        return Excel::download(new AlmacenesExport($request), 'Almacenes.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $almacenes = Almacen::find($request);

              
        $pdf = PDF::loadView('pdf.almacenes', compact('almacenes'));
       
        return $pdf->stream();

    }
}
