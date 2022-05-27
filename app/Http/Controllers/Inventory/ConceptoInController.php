<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConceptoIn;
use App\Models\TipoPoliza;
use App\Models\Cuentaco;
use App\Models\FolioConcepto;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConceptoinExport;
use Barryvdh\DomPDF\Facade as PDF;

class ConceptoInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datasave = request()->datasave;

        if ($datasave) {
            $conceptoin =  ConceptoIn::select('CONCEPTO_IN_ID', 'NOMBRE','NATURALEZA', 'is_active')->get();
       
            return Inertia::render('Inventory/Conceptos/Index')->with(compact('conceptoin'));
        } else {

            $conceptoin =  ConceptoIn::select('CONCEPTO_IN_ID', 'NOMBRE','NATURALEZA', 'is_active')->where('OCULTO', 'N')->get();
          
            return Inertia::render('Inventory/Conceptos/Index')->with(compact('conceptoin'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipopoliza = TipoPoliza::select('TIPO_POLIZA_ID', 'NOMBRE')->where('is_active', 1)->get();
        $cuentasco = Cuentaco::select('CUENTA_ID', 'NOMBRE', 'SUBCUENTA')->where('is_active', '=', 1)->get();

        return Inertia::render('Inventory/Conceptos/Create')->with(compact('tipopoliza', 'cuentasco'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $guardar = new ConceptoIn();
        $guardar->NOMBRE = $request->NOMBRE;
        $guardar->NOMBRE_ABREV = $request->NOMBRE_ABREV;
        $guardar->NATURALEZA = $request->NATURALEZA;
        $guardar->FOLIO_AUTOM = $request->FOLIO_AUTOM ? 'S' : 'N';
        $guardar->CENTROS_COSTO = $request->CENTROS_COSTO ? 'S' : 'N';
        if ($request->TIPO == 'Compra') {
            $guardar->TIPO = 'C';
        } elseif ($request->TIPO == 'Devolución') {
            $guardar->TIPO = 'D';
        } else {
            $guardar->TIPO = 'O';
        }
        $guardar->ES_PREDET = $request->ES_PREDET ? 'S' : 'N';
        $guardar->OCULTO = $request->OCULTO ? 'S' : 'N';
        $guardar->TIPO_CALCULO = $request->TIPO_CALCULO ? 'S' : 'N';
        $guardar->CREAR_POLIZAS = $request->CREAR_POLIZAS ? 'S' : 'N';
        $guardar->ID_INTERNO = $request->ID_INTERNO;

        if ($request->CREAR_POLIZAS == true) {
            if ($request->TIPO_POLIZA == 72) {
                $guardar->TIPO_POLIZA = 'D';
            } elseif ($request->TIPO_POLIZA == 73) {
                $guardar->TIPO_POLIZA = 'E';
            } else {
                $guardar->TIPO_POLIZA = 'I';
            }

            $guardar->DESCRIPCION_POLIZA = $request->DESCRIPCION_POLIZA;
            $guardar->CUENTA_CONTABLE = $request->CUENTA_CONTABLE;
            $guardar->PREG_CUENTA = $request->PREG_CUENTA ? 'S' : 'N';
        }

        $guardar->FECHA_HORA_CREACION = Carbon::now();
        $guardar->FECHA_HORA_ULT_MODIF = Carbon::now();

        $guardar->save();


        if ($request->FOLIO_AUTOM == true) {
            $folioconcepto = new FolioConcepto();
            $folioconcepto->SISTEMA = 'IN';
            $folioconcepto->CONCEPTO_ID = $guardar->CONCEPTO_IN_ID;
            $folioconcepto->SUCURSAL_ID = 135111;
            $folioconcepto->SERIE = $request->SERIE;
            $folioconcepto->CONSECUTIVO = $request->CONSECUTIVO;
            $folioconcepto->save();
        }


        if($request->CREATEORCLOSE == 2 || $request->CREATEORCLOSE == '2' )
        {
            return Redirect::route('conceptoin.create'); 
        }
        else{
            return Redirect::route('conceptoin.index');

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
        $tipopoliza = TipoPoliza::select('TIPO_POLIZA_ID', 'NOMBRE')->where('is_active', 1)->get();
        $cuentasco = Cuentaco::select('CUENTA_ID', 'NOMBRE', 'SUBCUENTA')->where('is_active', '=', 1)->get();
        $conceptoin = ConceptoIn::find($id);
        $conceptoin->ES_PREDET = $conceptoin->ES_PREDET == 'S' ? true : false;
        $conceptoin->OCULTO  = $conceptoin->OCULTO == 'S' ? true : false;
        $conceptoin->CENTROS_COSTO  = $conceptoin->CENTROS_COSTO == 'S' ? true : false;
        $conceptoin->TIPO_CALCULO  = $conceptoin->TIPO_CALCULO == 'S' ? true : false;
        $conceptoin->CREAR_POLIZAS  = $conceptoin->CREAR_POLIZAS == 'S' ? true : false;
        $conceptoin->PREG_CUENTA  = $conceptoin->PREG_CUENTA == 'S' ? true : false;
        
        
        return Inertia::render('Inventory/Conceptos/Edit', ['conceptoin' => $conceptoin, 'tipopoliza' => $tipopoliza, 'cuentasco' => $cuentasco]);
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

        $update = ConceptoIn::where('CONCEPTO_IN_ID', '=', $request->CONCEPTO_IN_ID)->first();

    

        $update->NOMBRE = $request->NOMBRE;
        $update->NOMBRE_ABREV = $request->NOMBRE_ABREV;
        $update->NATURALEZA = $request->NATURALEZA;
        $update->FOLIO_AUTOM = $request->FOLIO_AUTOM ? 'S' : 'N';
        $update->CENTROS_COSTO = $request->CENTROS_COSTO ? 'S' : 'N';
        if ($request->TIPO == 'Compra') {
            $update->TIPO = 'C';
        } elseif ($request->TIPO == 'Devolución') {
            $update->TIPO = 'D';
        } else {
            $update->TIPO = 'O';
        }
        $update->ES_PREDET = $request->ES_PREDET ? 'S' : 'N';
        $update->OCULTO = $request->OCULTO ? 'S' : 'N';
        $update->TIPO_CALCULO = $request->TIPO_CALCULO ? 'S' : 'N';
        $update->CREAR_POLIZAS = $request->CREAR_POLIZAS ? 'S' : 'N';
        $update->ID_INTERNO = $request->ID_INTERNO;

        if ($request->CREAR_POLIZAS == true) {
            if ($request->TIPO_POLIZA == 72) {
                $update->TIPO_POLIZA = 'D';
            } elseif ($request->TIPO_POLIZA == 73) {
                $update->TIPO_POLIZA = 'E';
            } else {
                $update->TIPO_POLIZA = 'I';
            }

            $update->DESCRIPCION_POLIZA = $request->DESCRIPCION_POLIZA;
            $update->CUENTA_CONTABLE = $request->CUENTA_CONTABLE;
            $update->PREG_CUENTA = $request->PREG_CUENTA ? 'S' : 'N';
        }

        $update->FECHA_HORA_ULT_MODIF = Carbon::now();
        $update->save();

        if ($id == 2) {
            return Redirect::route('conceptoin.create');
        } else {
            return Redirect::route('conceptoin.index');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($CONCEPTO_IN_ID)
    {
        $getServices = ConceptoIn::where('CONCEPTO_IN_ID', '=', $CONCEPTO_IN_ID)->first();
        $getServices->is_active = !$getServices->is_active;
        $getServices->save();

        return Redirect::route('conceptoin.index');
    }



    public function export(Request $request)
    {
        return Excel::download(new ConceptoinExport($request), 'Conceptoin.xlsx');
    }


    public function pdf(Request $request)
    {
        $conceptosin = ConceptoIn::find($request);


        $pdf = PDF::loadView('pdf.conceptosin', compact('conceptosin'));

        return $pdf->stream();
    }
}
