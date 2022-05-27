<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\LineaArticulo;
use App\Models\GrupoLinea;
use App\Models\ClasificadorCat;
use App\Models\ClaveArticulo;
use App\Models\Almacen;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Sucursal;

class KardexDelInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal = Sucursal::where('is_active',1)->get();
        $lineadearticulos = LineaArticulo::select('LINEA_ARTICULO_ID','NOMBRE')->where('is_active',1)->get();
        $gruposarticulos= GrupoLinea::select('GRUPO_LINEA_ID','NOMBRE')->where('is_active',1)->get();  
        $clasificadorescat=ClasificadorCat::select('CLASIFICADOR_ID','NOMBRE')->where('is_active',1)->get();
$almacenes=Almacen::select('ALMACEN_ID','NOMBRE')->where('is_active',1)->get();

        $relacionc=ClaveArticulo::with('relacion_articulos')->get(); /* El with se utiliza para poder mandar una relación ala vista*/
       
        $relacionclave=[];
foreach ($relacionc as $relacion )
{
    $relacionclave[] = ['CLAVE_ARTICULO'=> $relacion->CLAVE_ARTICULO,'CLAVE_ARTICULO_ID'=> $relacion->CLAVE_ARTICULO_ID,'relacion_articulos'=>['NOMBRE'=>$relacion->relacion_articulos->NOMBRE, 'UNIDAD_COMPRA'=>$relacion->relacion_articulos->UNIDAD_COMPRA]];
    
}


        return Inertia::render('Inventory/KardexDelInventario/Index')->with(compact('sucursal','lineadearticulos','gruposarticulos','clasificadorescat','relacionclave','almacenes'));
        
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
