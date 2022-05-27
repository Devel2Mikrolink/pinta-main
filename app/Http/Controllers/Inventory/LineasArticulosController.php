<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\LineaArticulo;
use App\Models\GrupoLinea;
use App\Models\Cuentaco;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LineasArticulosExport;
use Barryvdh\DomPDF\Facade as PDF;
class LineasArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $datasave = request()->datasave;

        // dd([request()->all(),$datasave, $datasave ? true : false, $datasave == null ? false : true]);
        //  $centrodecostos = CentroCosto::all();


        // dd([$startDate,$endDate]);

        if($datasave  ){
            $lineasarticulos = LineaArticulo::select('LINEA_ARTICULO_ID','NOMBRE' , 'OCULTO','is_active')->get();
      
            return Inertia::render('Inventory/LineasArticulos/Index')->with(compact('lineasarticulos'));
           
        }
        else{
            $lineasarticulos = LineaArticulo::select('LINEA_ARTICULO_ID','OCULTO','NOMBRE','is_active')->where('OCULTO','N')->get();
            
            return Inertia::render('Inventory/LineasArticulos/Index')->with(compact('lineasarticulos'));
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
        $gruposlineas= GrupoLinea::select('GRUPO_LINEA_ID','NOMBRE')->where('is_active',"=",1)->get();
        return Inertia::render('Inventory/LineasArticulos/Create')->with(compact('cuentasco','gruposlineas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $guardar = new LineaArticulo();
        $guardar->NOMBRE= $request->NOMBRE;
        $guardar->GRUPO_LINEA_ID=$request->GRUPO_LINEA_ID;
       
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
        

        $guardar->CUENTA_ALMACEN = $request->CUENTA_ALMACEN;
        $guardar->CUENTA_COSTO_VENTA = $request->CUENTA_COSTO_VENTA;
        $guardar->CUENTA_COMPRAS = $request->CUENTA_COMPRAS;
        $guardar->CUENTA_DEVOL_COMPRAS = $request->CUENTA_DEVOL_COMPRAS;
        $guardar->CUENTA_VENTAS = $request->CUENTA_VENTAS;
        $guardar->CUENTA_DEVOL_VENTAS = $request->CUENTA_DEVOL_VENTAS;
        
        
        
        
        $guardar->ES_PREDET = $request->ES_PREDET == true  ? 'S' : 'N';
        $guardar->OCULTO = $request->OCULTO == true  ? 'S' : 'N';
        $guardar->FECHA_HORA_CREACION=Carbon::now();
        $guardar->FECHA_HORA_ULT_MODIF=Carbon::now();
    
       
        $guardar->save();

        if($request->CREATEORCLOSE == 2)
        {
            return Redirect::route('lineasarticulos.create'); 
        }
        else{
            return Redirect::route('lineasarticulos.index');

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
        $lineasarticulo = LineaArticulo::find($id);
        $cuentasco=Cuentaco::select('CUENTA_ID', 'NOMBRE','SUBCUENTA')->where('is_active','=',1)->get();
        $gruposlineas= GrupoLinea::select('GRUPO_LINEA_ID','NOMBRE')->where('is_active',"=",1)->get();
        $lineasarticulo->ES_PREDET = $lineasarticulo->ES_PREDET == 'S' ? true : false;
        $lineasarticulo->OCULTO  = $lineasarticulo->OCULTO == 'S' ? true : false;
        $lineasarticulo->APLICAR_FACTOR_VENTA  = $lineasarticulo->APLICAR_FACTOR_VENTA == 'S' ? true : false;
    
        return Inertia::render('Inventory/LineasArticulos/Edit', ['lineasarticulo' => $lineasarticulo,'cuentasco'=>$cuentasco,'gruposlineas'=>$gruposlineas]);
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

        
        $guardar = LineaArticulo::where('LINEA_ARTICULO_ID','=',$request->LINEA_ARTICULO_ID)->first();

        $guardar->NOMBRE= $request->NOMBRE;
        $guardar->GRUPO_LINEA_ID=$request->GRUPO_LINEA_ID;
        if($request->APLICAR_FACTOR_VENTA == true)
        {
            $guardar->APLICAR_FACTOR_VENTA='S';
        }
        $guardar->FACTOR_VENTA=$request->FACTOR_VENTA;
     
        $guardar->FECHA_HORA_ULT_MODIF=Carbon::now();
        $guardar->ES_PREDET = $request->ES_PREDET == true ? 'S' : 'N';
        $guardar->OCULTO = $request->OCULTO == true ? 'S' : 'N';
        $guardar->CUENTA_ALMACEN = $request->CUENTA_ALMACEN;
        $guardar->CUENTA_COSTO_VENTA = $request->CUENTA_COSTO_VENTA;
        $guardar->CUENTA_COMPRAS = $request->CUENTA_COMPRAS;
        $guardar->CUENTA_DEVOL_COMPRAS = $request->CUENTA_DEVOL_COMPRAS;
        $guardar->CUENTA_VENTAS = $request->CUENTA_VENTAS;
        $guardar->CUENTA_DEVOL_VENTAS = $request->CUENTA_DEVOL_VENTAS;
        
        $guardar->save();


        if($id == 2)
        {        return Redirect::route('lineasarticulos.create');
        }
        else{
            return Redirect::route('lineasarticulos.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($LINEA_ARTICULO_ID)
    {
        $getServices =LineaArticulo::where('LINEA_ARTICULO_ID','=',$LINEA_ARTICULO_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('lineasarticulos.index');
    }


    public function export(Request $request) 
    {
        
        
        return Excel::download(new LineasArticulosExport($request), 'Lineasarticulos.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $lineasarticulos = LineaArticulo::find($request);

              
        $pdf = PDF::loadView('pdf.lineasarticulos', compact('lineasarticulos'));
       
        return $pdf->stream();

    }
}
