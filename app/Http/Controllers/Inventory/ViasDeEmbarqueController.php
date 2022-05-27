<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ViaEmbarque;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ViasdeembarqueExport;
use Barryvdh\DomPDF\Facade as PDF;



class ViasDeEmbarqueController extends Controller
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
        $viasdeembarque = ViaEmbarque::select('VIA_EMBARQUE_ID','NOMBRE','is_active')->get();
        
 /**en la parte del return retorna la vista que en realidad es una ruta que se declaro en el web.php y con el with se 
  * le especifica que se mande con esa variable
  */
        return Inertia::render('Inventory/ViasDeEmbarque/Index')->with(compact('viasdeembarque'));
    }

    public function indexCompras()
    {
          /**se crea una variable llamada paises lo que significa que del modelo pais se va a extraer todoo el modelo del pais 
         * se debe de declarar en la parte de arriba ademas lo que se utiliza es eloquent 
         */
        $viasdeembarque = ViaEmbarque::select('VIA_EMBARQUE_ID','NOMBRE','is_active')->get();
        
 /**en la parte del return retorna la vista que en realidad es una ruta que se declaro en el web.php y con el with se 
  * le especifica que se mande con esa variable
  */
        return Inertia::render('Compras/ViasEmbarque/Index')->with(compact('viasdeembarque'));
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
    public function store($root , Request $request)
    {
        


        $guardar = new ViaEmbarque();
        $guardar->NOMBRE = $request->NOMBRE;
        if($request->ES_PREDET == true)
        {
            $guardar->ES_PREDET='S';
        }
        $guardar->FECHA_HORA_CREACION=Carbon::now();
        $guardar->FECHA_HORA_ULT_MODIF=Carbon::now();
       
        $guardar->save();



        return Redirect::route($root);
    }

    public function storeCompras(Request $request)
    {
        
        $guardar = new ViaEmbarque();
        $guardar->NOMBRE = $request->NOMBRE;
        if($request->ES_PREDET == true)
        {
            $guardar->ES_PREDET='S';
        }
        $guardar->FECHA_HORA_CREACION=Carbon::now();
        $guardar->FECHA_HORA_ULT_MODIF=Carbon::now();
       
        $guardar->save();
        return Redirect::route('indexCompras');
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
        $update = ViaEmbarque::where('VIA_EMBARQUE_ID','=',$request->VIA_EMBARQUE_ID)->first();

        $update->NOMBRE = $request->NOMBRE;
       
       
        if($request->check == true)
        {
            $update->ES_PREDET = 'S';
        }
        $update->FECHA_HORA_ULT_MODIF=Carbon::now();
     
        
        $update->save();
        return Redirect::route('viasdeembarque.index');
    }

    public function updateCompras(Request $request)
    {
        $update = ViaEmbarque::where('VIA_EMBARQUE_ID','=',$request->VIA_EMBARQUE_ID)->first();

        $update->NOMBRE = $request->NOMBRE;
       
       
        if($request->check == true)
        {
            $update->ES_PREDET = 'S';
        }
        $update->FECHA_HORA_ULT_MODIF=Carbon::now();
     
        
        $update->save();
        return Redirect::route('indexCompras');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($VIA_EMBARQUE_ID)
    {
        
        $getServices =ViaEmbarque::where('VIA_EMBARQUE_ID','=',$VIA_EMBARQUE_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('viasdeembarque.index');
    }

  


    public function destroyCompras($VIA_EMBARQUE_ID)
    {
        
        $getServices =ViaEmbarque::where('VIA_EMBARQUE_ID','=',$VIA_EMBARQUE_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('indexCompras');
    }

    public function export(Request $request) 
    {
        
        
        
        return Excel::download(new ViasdeembarqueExport($request), 'Viasdeembarque.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $viasdeembarque = ViaEmbarque::find($request);

              
        $pdf = PDF::loadView('pdf.viasdeembarque', compact('viasdeembarque'));
       
        return $pdf->stream();

    }
}
