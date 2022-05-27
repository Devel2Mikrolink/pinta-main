<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ConceptoIn;
use App\Models\Almacen;
use App\Models\ClaveArticulo;
use Carbon\Carbon;
use App\Models\ClasificadorCat;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CiudadesExport;
use Barryvdh\DomPDF\Facade as PDF;

class ClasificadoresDeArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clasificadoresdearticulos = ClasificadorCat::all();
        return Inertia::render('Inventory/ClasificadoresDeArticulos/Index')->with(compact('clasificadoresdearticulos'));
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

        return Inertia::render('Inventory/ClasificadoresDeArticulos/Create')->with(compact('conceptos', 'almacenes', 'relacionclave'));
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
