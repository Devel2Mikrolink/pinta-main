<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ConceptoIn;
use App\Models\Almacen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CentroCostosExport;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\CentroCosto;

class CentroDeCostosController extends Controller
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
            $centrodecostos = CentroCosto::all();
            return Inertia::render('Inventory/CentroDeCostos/Index')->with(compact('centrodecostos'));
           
        }
        else{
            $centrodecostos = CentroCosto::where('OCULTO','N')->get();
            return Inertia::render('Inventory/CentroDeCostos/Index')->with(compact('centrodecostos'));
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Inventory/CentroDeCostos/Create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Tambien guarda clave pero en la tabla no hahy un campo para eso solo en la vista 
        // se tendria que investigar en donde se esta guardando
       
        $guardar = new CentroCosto();
        $guardar->NOMBRE = $request->NOMBRE;
        $guardar->ES_PREDET = $request->ES_PREDET == true ? 'S' : 'N';
        $guardar->OCULTO = $request->OCULTO == true ? 'S' : 'N';
        $guardar->FECHA_HORA_CREACION = Carbon::now();
        $guardar->FECHA_HORA_ULT_MODIF= Carbon::now();
        $guardar->save();


          
        if($request->CREATEORCLOSE == 2)
        {
            return Redirect::route('centrodecostos.create'); 
        }
        else{
            return Redirect::route('centrodecostos.index');

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
        $centrocosto = CentroCosto::find($id);

        $centrocosto->ES_PREDET = $centrocosto->ES_PREDET == 'S' ? true : false;
        $centrocosto->OCULTO  = $centrocosto->OCULTO == 'S' ? true : false;
        return Inertia::render('Inventory/CentroDeCostos/Edit', ['centrocosto' => $centrocosto]);
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
      
        $update = CentroCosto::where('CENTRO_COSTO_ID','=',$request->CENTRO_COSTO_ID)->first();

        $update->NOMBRE = $request->NOMBRE;
        $update->ES_PREDET = $request->ES_PREDET == true ? 'S' : 'N';
        $update->OCULTO = $request->OCULTO == true ? 'S' : 'N';
        $update->FECHA_HORA_ULT_MODIF= Carbon::now();
       
        
        $update->save();

        if($id == 2)
        {
            return Redirect::route('centrodecostos.create'); 
        }
        else{
            return Redirect::route('centrodecostos.index');

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($CENTRO_COSTO_ID)
    {
        $getServices =CentroCosto::where('CENTRO_COSTO_ID','=',$CENTRO_COSTO_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('centrodecostos.index');
    }


    public function export(Request $request) 
    {
        
        
        return Excel::download(new CentroCostosExport($request), 'centrodecostos.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $centrodecostos = CentroCosto::find($request);

              
        $pdf = PDF::loadView('pdf.centrodecostos', compact('centrodecostos'));
       
        return $pdf->stream();

        

    }
}
