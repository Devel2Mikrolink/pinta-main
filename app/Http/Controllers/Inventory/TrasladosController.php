<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaisesExport;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\DoctoIn;
use App\Models\ConceptoIn;
use App\Models\Almacen;
use App\Models\DoctoInDet;
use App\Models\LugarExpedicion;
use App\Models\ClaveArticulo;
class TrasladosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
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
            $relacionarticulo[] = ['NOMBREALMACEN' => $relacion->relacion_almacen->NOMBRE,'NOMBRE' => $relacion->relacion_articulo->NOMBRE, 'NOMBRECONCEPTO' => $relacion->relacion_concepto_in->NOMBRE,'FOLIO' => $relacion->relacion_docto_in->FOLIO, 'DOCTO_IN_DET_ID' => $relacion->DOCTO_IN_DET_ID, 'is_active' => $relacion->relacion_articulo->is_active];
        }


        $entradasdoctoin=DoctoIn::select('CONCEPTO_IN_ID','ALMACEN_ID','DOCTO_IN_ID','FOLIO','FECHA','is_active')->with('relacion_almacen')->with('relacion_concepto_in')->get();


        return Inertia::render('Inventory/Traslados/Index')->with(compact('entradasdoctoin'));
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
$lugarexpedicion = LugarExpedicion::select('LUGAR_EXPEDICION_ID', 'NOMBRE')->where('is_active', '=', 1)->get();
        $relacionc = ClaveArticulo::with('relacion_articulos')->get(); /* El with se utiliza para poder mandar una relación ala vista*/
        $preciosarticulos =
            $relacionclave = [];
        foreach ($relacionc as $relacion) {
            $relacionclave[] = ['CLAVE_ARTICULO' => $relacion->CLAVE_ARTICULO, 'CLAVE_ARTICULO_ID' => $relacion->CLAVE_ARTICULO_ID, 'relacion_articulos' => ['NOMBRE' => $relacion->relacion_articulos->NOMBRE, 'UNIDAD_COMPRA' => $relacion->relacion_articulos->UNIDAD_COMPRA, 'ARTICULO_ID' => $relacion->relacion_articulos->ARTICULO_ID]];
        }


        return Inertia::render('Inventory/Traslados/Create')->with(compact('conceptos', 'almacenes', 'relacionclave','lugarexpedicion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
