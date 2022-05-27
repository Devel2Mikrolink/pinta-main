<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ConceptoIn;
use App\Models\Almacen;
use App\Models\Articulo;
use App\Models\ClaveArticulo;
use App\Models\Ciudad;
use App\Models\DoctoIn;
use App\Models\DoctoInDet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CiudadesExport;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class EntradasInventariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $startDate = request()->startDate ? Carbon::parse(request()->startDate) : null;
        $endDate = request()->endDate ? Carbon::parse(request()->endDate) : null;

        // dd([$startDate,$endDate]);

        if(!$startDate || !$endDate ){

            $startDate = Carbon::now()->addMonth(-1); 
            $endDate = Carbon::now();
        }
        dd([$startDate,$endDate]);
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        /**se crea una variable llamada paises lo que significa que del modelo pais se va a extraer todoo el modelo del pais 
         * se debe de declarar en la parte de arriba ademas lo que se utiliza es eloquent 
         */
        //  $paises = Pais::all();

        /**en la parte del return retorna la vista que en realidad es una ruta que se declaro en el web.php y con el with se 
         * le especifica que se mande con esa variable
         */
        $relacionc = DoctoInDet::where('TIPO_MOVTO', '=', 'E')->with('relacion_almacen')->with('relacion_concepto_in')->with('relacion_docto_in')->with('relacion_articulo')->get(); /* El with se utiliza para poder mandar una relación ala vista*/

        $relacionarticulo = [];
        foreach ($relacionc as $relacion) {
            $relacionarticulo[] = ['NOMBREALMACEN' => $relacion->relacion_almacen->NOMBRE, 'NOMBRE' => $relacion->relacion_articulo->NOMBRE, 'NOMBRECONCEPTO' => $relacion->relacion_concepto_in->NOMBRE, 'FOLIO' => $relacion->relacion_docto_in->FOLIO, 'DOCTO_IN_DET_ID' => $relacion->DOCTO_IN_DET_ID, 'is_active' => $relacion->relacion_articulo->is_active];
        }


        $entradasdoctoin = DoctoIn::whereBetween('FECHA',[$startDate,$endDate])->select('CONCEPTO_IN_ID', 'ALMACEN_ID', 'DOCTO_IN_ID', 'FOLIO', 'FECHA', 'is_active')->with('relacion_almacen')->with('relacion_concepto_in')->get();

        return Inertia::render('Inventory/EntradasInventory/Index')->with(compact('entradasdoctoin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $conceptos = ConceptoIn::select('CONCEPTO_IN_ID', 'NOMBRE')->where('is_active', '=', 1)->where('NATURALEZA', '=', 'E')->get();
        $almacenes = Almacen::select('ALMACEN_ID', 'NOMBRE')->where('is_active', '=', 1)->get();

        $relacionc = ClaveArticulo::with('relacion_articulos')->get(); /* El with se utiliza para poder mandar una relación ala vista*/
        $preciosarticulos =
            $relacionclave = [];
        foreach ($relacionc as $relacion) {
            $relacionclave[] = ['CLAVE_ARTICULO' => $relacion->CLAVE_ARTICULO, 'CLAVE_ARTICULO_ID' => $relacion->CLAVE_ARTICULO_ID, 'relacion_articulos' => ['NOMBRE' => $relacion->relacion_articulos->NOMBRE, 'UNIDAD_COMPRA' => $relacion->relacion_articulos->UNIDAD_COMPRA, 'ARTICULO_ID' => $relacion->relacion_articulos->ARTICULO_ID]];
        }


        return Inertia::render('Inventory/EntradasInventory/Create')->with(compact('conceptos', 'almacenes', 'relacionclave'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guardarDocto = new DoctoIn();
        $guardarDocto->ALMACEN_ID = $request->ALMACEN_ID;
        $guardarDocto->CONCEPTO_IN_ID = $request->CONCEPTO_IN_ID;
        $guardarDocto->SUCURSAL_ID = 135111;
        $guardarDocto->FOLIO = 'FG0002054';
        $guardarDocto->NATURALEZA_CONCEPTO = 'E';
        $guardarDocto->FECHA = Carbon::now();
        $guardarDocto->DESCRIPCION = $request->DESCRIPCION;
        $guardarDocto->CONTABILIZADO = $request->CONTABILIZADO == true ? 'S' : 'N';
        $guardarDocto->FORMA_EMITIDA = $request->FORMA_EMITIDA == true ? 'S' : 'N';
        $guardarDocto->SISTEMA_ORIGEN = 'EN';
        $guardarDocto->FECHA_HORA_CREACION = Carbon::now();
        $guardarDocto->FECHA_HORA_ULT_MODIF = Carbon::now();
        $guardarDocto->FECHA_HORA_CANCELACION = Carbon::now();
        $guardarDocto->is_active = 1;

        $guardarDocto->save();


        foreach ($request->ARTICULOS as $articulo) {

            $guardarDoctoInDet = new DoctoInDet();


            $guardarDoctoInDet->DOCTO_IN_ID = $guardarDocto->DOCTO_IN_ID;
            $guardarDoctoInDet->ALMACEN_ID = $request->ALMACEN_ID;
            $guardarDoctoInDet->CONCEPTO_IN_ID = $request->CONCEPTO_IN_ID;
            $guardarDoctoInDet->CLAVE_ARTICULO = $articulo['CLAVE_ARTICULO'];
            $guardarDoctoInDet->ARTICULO_ID = $articulo['ARTICULO_ID'];
            $guardarDoctoInDet->TIPO_MOVTO = 'E';
            $guardarDoctoInDet->UNIDADES = $articulo['UNIDADES'];
            $guardarDoctoInDet->COSTO_UNITARIO = $articulo['COSTO_UNITARIO'];
            $guardarDoctoInDet->COSTO_TOTAL = $articulo['COSTO_TOTAL'];
            $guardarDoctoInDet->METODO_COSTEO = 'C';
            $guardarDoctoInDet->FECHA = Carbon::now();
            $guardarDoctoInDet->save();
            $enviarid = $guardarDoctoInDet->DOCTO_IN_DET_ID;

            $result = DB::select(
                DB::raw('CALL APLICA_ENTRADA_IN(?)'),
                array($enviarid)
            );
        }


        return Redirect::route('entradasinventarios.index');
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
        $entradadoctoin = DoctoIn::with('relacion_docto_in_det')->find($id);

        $conceptos = ConceptoIn::select('CONCEPTO_IN_ID', 'NOMBRE')->where('is_active', '=', 1)->where('NATURALEZA', '=', 'E')->get();
        $almacenes = Almacen::select('ALMACEN_ID', 'NOMBRE')->where('is_active', '=', 1)->get();

        $relacionc = ClaveArticulo::with('relacion_articulos')->get(); /* El with se utiliza para poder mandar una relación ala vista*/
        $preciosarticulos =
            $relacionclave = [];
        foreach ($relacionc as $relacion) {
            $relacionclave[] = ['CLAVE_ARTICULO' => $relacion->CLAVE_ARTICULO, 'CLAVE_ARTICULO_ID' => $relacion->CLAVE_ARTICULO_ID, 'relacion_articulos' => ['NOMBRE' => $relacion->relacion_articulos->NOMBRE, 'UNIDAD_COMPRA' => $relacion->relacion_articulos->UNIDAD_COMPRA, 'ARTICULO_ID' => $relacion->relacion_articulos->ARTICULO_ID]];
        }
        return Inertia::render('Inventory/EntradasInventory/Edit', ['entradadoctoin' => $entradadoctoin])->with(compact('conceptos', 'almacenes', 'relacionclave'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($DOCTO_IN_ID)
    {

        $articulos = DoctoInDet::where('DOCTO_IN_ID', $DOCTO_IN_ID)->get();


        foreach ($articulos as $articulo) {


            $enviariddoctoindet = $articulo->DOCTOS_IN_DET_ID;


            $result = DB::select(
                DB::raw('CALL DESAPLICA_ENTRADA_IN(?)'),
                array($enviariddoctoindet)
            );
        }

        // $productoId = DoctoIn::findOrFail($DOCTO_IN_ID);

        // $productoId->relacion_docto_in_det()->detach($DOCTO_IN_ID);



        return Redirect::route('entradasinventarios.index');
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

    public function pdfnotsave(Request $request)
    {


        $ciudades = Ciudad::find($request);


        $pdf = PDF::loadView('pdf.ciudades', compact('ciudades'));

        return $pdf->stream();
    }
}
