<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pais;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaisesExport;
use Barryvdh\DomPDF\Facade as PDF;


class PaisesController extends Controller
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
        $paises = Pais::select('PAIS_ID', 'NOMBRE','NOMBRE_ABREV','is_active','CLAVE_FISCAL','ES_PREDET')->get();
        
 /**en la parte del return retorna la vista que en realidad es una ruta que se declaro en el web.php y con el with se 
  * le especifica que se mande con esa variable
  */
        return Inertia::render('Inventory/Paises/Index')->with(compact('paises'));
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
        

       
        $guardarpais = new Pais();
        $guardarpais->NOMBRE = $request->NOMBRE;
        $guardarpais->NOMBRE_ABREV=$request->NOMBRE_ABREV;
        $guardarpais->CLAVE_FISCAL=$request->CLAVE_FISCAL;
        if($request->ES_PREDET == true)
        {
            $guardarpais->ES_PREDET='S';
        }
        $guardarpais->FECHA_HORA_CREACION=Carbon::now();
        $guardarpais->FECHA_HORA_ULT_MODIF=Carbon::now();
       
        $guardarpais->save();
        return Redirect::route('paises.index');
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
       
        $update = Pais::where('PAIS_ID','=',$request->PAIS_ID)->first();

        $update->NOMBRE = $request->NOMBRE;
        $update->NOMBRE_ABREV = $request->NOMBRE_ABREV;
        $update->CLAVE_FISCAL = $request->CLAVE_FISCAL;
       
        if($request->check == true)
        {
            $update->ES_PREDET = 'S';
        }
        $update->FECHA_HORA_ULT_MODIF=Carbon::now();
        
        $update->save();
        return Redirect::route('paises.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($PAIS_ID)
    {
       
        $getServices =Pais::where('PAIS_ID','=',$PAIS_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('paises.index');
    }


    public function export(Request $request) 
    {
        
        
        return Excel::download(new PaisesExport($request), 'Paises.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $paises = Pais::find($request);

              
        $pdf = PDF::loadView('pdf.paises', compact('paises'));
       
        return $pdf->stream();

    }
}

