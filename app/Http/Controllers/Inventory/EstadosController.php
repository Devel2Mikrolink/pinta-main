<?php

namespace App\Http\Controllers\Inventory;
/**Siempre que se deba de usar algo de otro archivo es necesario declararlo en esta parte */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Estado;
use App\Models\Pais;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstadosExport;
use Barryvdh\DomPDF\Facade as PDF;

class EstadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**se define una variable estados la que guardara todos los estados que se extraen del modelo que se esta declarando de la parte de arriba 
         * y con la sintaxis de all() se le esta indicando que traega todo
         */
        $estados = Estado::select('ESTADO_ID', 'NOMBRE','NOMBRE_ABREV','CLAVE_FISCAL','ES_PREDET', 'is_active')->get();
        $paises = Pais::select('PAIS_ID', 'NOMBRE')->where('is_active',1)->get();
        /**en la parte de return es la vista que se esta regresando que quiere decir que engrese ala carpeta view/js/pages/Inventory/Estados/Index.vue ademas de que con
         * el with quiere decir que se le incluye esa variable para que se mande 
         */
 
        return Inertia::render('Inventory/Estados/Index')->with(compact('estados','paises'));
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
       
       
        $guardarestado = new Estado();
        $guardarestado->NOMBRE = $request->NOMBRE;
        $guardarestado->NOMBRE_ABREV=$request->NOMBRE_ABREV;
        $guardarestado->CLAVE_FISCAL=$request->CLAVE_FISCAL;
        $guardarestado->PAIS_ID=$request->PAIS_ID;
        if($request->ES_PREDET == true)
        {
            $guardarestado->ES_PREDET='S';
        }
    
        $guardarestado->FECHA_HORA_CREACION=Carbon::now();
        $guardarestado->FECHA_HORA_ULT_MODIF=Carbon::now();

        $guardarestado->save();
        return Redirect::route('estados.index');
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
        $update = Estado::where('ESTADO_ID','=',$request->ESTADO_ID)->first();

        $update->NOMBRE = $request->NOMBRE;
        $update->NOMBRE_ABREV = $request->NOMBRE_ABREV;
        $update->CLAVE_FISCAL = $request->CLAVE_FISCAL;
        $update->PAIS_ID = $request->PAIS_ID;
       
        if($request->check == true)
        {
            $update->ES_PREDET = 'S';
        }
        $update->FECHA_HORA_ULT_MODIF=Carbon::now();
        
        $update->save();
        return Redirect::route('estados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ESTADO_ID)
    {
        
        $getServices =Estado::where('ESTADO_ID','=',$ESTADO_ID)->first();
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('estados.index');
    }

    public function export(Request $request) 
    {
        
        
        
        return Excel::download(new EstadosExport($request), 'Estados.xlsx');
    }

    
    public function pdf(Request $request)
    {

       
              $estados = Estado::find($request);

              
        $pdf = PDF::loadView('pdf.estados', compact('estados'));
       
        return $pdf->stream();

    }
}
