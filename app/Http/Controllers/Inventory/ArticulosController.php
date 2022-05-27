<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Articulo;
use App\Models\LineaArticulo;
use App\Models\UnidadVenta;
use App\Models\ClaveArticulo;
use App\Models\Almacen;
use App\Models\RolClaveArticulo;
use App\Models\Cuentaco;
use App\Models\ClasificadorCat;
use App\Models\ClasificadorCatValor;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaisesExport;
use Barryvdh\DomPDF\Facade as PDF;

class ArticulosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $todoslosarticulos = request()->todoslosarticulos;
        $exeptobajas = request()->exeptobajas;
        $activos = request()->activos;
        $suspenciondecompras = request()->suspenciondecompras;
        $suspencionventas = request()->suspencionventas;
        $ambassuspenciones = request()->ambassuspenciones;
        $baja = request()->baja;





        // dd([request()->all(),$datasave, $datasave ? true : false, $datasave == null ? false : true]);
        //  $centrodecostos = CentroCosto::all();


        // dd([$startDate,$endDate]);

        if ($todoslosarticulos) {
            $articulos = Articulo::select('ARTICULO_ID', 'NOMBRE', 'is_active', 'ESTATUS')->get();
            return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
        } elseif ($exeptobajas) {
            $articulos = Articulo::select('ARTICULO_ID', 'NOMBRE', 'is_active', 'ESTATUS')->whereNotIn('ESTATUS', ['B'])->get();
            return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
        } elseif ($activos) {
            $articulos = Articulo::select('ARTICULO_ID', 'NOMBRE', 'is_active', 'ESTATUS')->where('ESTATUS', 'A')->get();


            return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
        } elseif ($suspenciondecompras) {
            $articulos = Articulo::select('ARTICULO_ID', 'NOMBRE', 'is_active', 'ESTATUS')->where('ESTATUS', 'C')->get();
            return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
        } elseif ($suspencionventas) {

            $articulos = Articulo::select('ARTICULO_ID', 'NOMBRE', 'is_active', 'ESTATUS')->where('ESTATUS', 'V')->get();



            return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
        } elseif ($ambassuspenciones) {
            $articulos = Articulo::select('ARTICULO_ID', 'NOMBRE', 'is_active', 'ESTATUS')->where('ESTATUS', 'S')->get();
            return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
        } elseif ($baja) {
            $articulos = Articulo::select('ARTICULO_ID', 'NOMBRE', 'is_active', 'ESTATUS')->where('ESTATUS', 'B')->get();
            return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
        } else {
            $articulos = Articulo::select('ARTICULO_ID', 'NOMBRE', 'is_active', 'ESTATUS')->get();
            return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
        }



        /**en la parte del return retorna la vista que en realidad es una ruta que se declaro en el web.php y con el with se 
         * le especifica que se mande con esa variable
         */
        return Inertia::render('Inventory/Articulos/Index')->with(compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lineasarticulos = LineaArticulo::all();
        $unidadesventa = UnidadVenta::select('UNIDAD_VENTA_ID', 'UNIDAD_VENTA')->where('is_active', '=', 1)->get();
        $almacenes = Almacen::select('ALMACEN_ID', 'NOMBRE')->where('is_active', '=', 1)->get();
        $rolarticulos = RolClaveArticulo::select('ROL_CLAVE_ART_ID', 'NOMBRE')->where('is_active', '=', 1)->get();
        $cuentasco = Cuentaco::select('CUENTA_ID', 'NOMBRE', 'SUBCUENTA')->where('is_active', '=', 1)->get();
        $sucursales = Sucursal::select('SUCURSAL_ID', 'NOMBRE')->where('is_active', '=', 1)->get();
        $clasificadorescat = ClasificadorCat::select('CLASIFICADOR_ID', 'NOMBRE')->where('is_active', '=', 1)->get();

        return Inertia::render('Inventory/Articulos/Create')->with(compact('clasificadorescat', 'rolarticulos', 'lineasarticulos', 'unidadesventa', 'almacenes', 'cuentasco', 'sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $guardar = new Articulo();
        $guardar->NOMBRE = $request->NOMBRE;
        $guardar->CODIGO_BARRA = $request->CODIGO_BARRA;
        $guardar->UNIDAD_VENTA = $request->UNIDAD_VENTA;
        $guardar->UNIDAD_COMPRA = $request->UNIDAD_COMPRA;
        $guardar->CONTENIDO_UNIDAD_COMPRA = $request->CONTENIDO_UNIDAD_COMPRA;
        $guardar->ES_ALMACENABLE = $request->ES_ALMACENABLE ? 'S' : 'N';
        $guardar->ES_JUEGO = $request->ES_JUEGO ? 'S' : 'N';


        if ($request->ESTATUS == 'Activo') {
            $guardar->ESTATUS = 'A';
        } elseif ($request->ESTATUS == 'Suspención de compras') {
            $guardar->ESTATUS = 'C';
        } elseif ($request->ESTATUS == 'Suspención de ventas') {
            $guardar->ESTATUS = 'V';
        } elseif ($request->ESTATUS == 'Suspención compras/ventas') {
            $guardar->ESTATUS = 'S';
        } else {
            $guardar->ESTATUS = 'B';
        }
        $guardar->CAUSA_SUSP = $request->CAUSA_SUSP;
        $guardar->FECHA_SUSP = $request->FECHA_SUSP;
        $guardar->PESO_UNITARIO = $request->PESO_UNITARIO;
        $guardar->ES_PESO_VARIABLE = $request->ES_PESO_VARIABLE ? 'S' : 'N';
        $guardar->SEGUIMIENTO = $request->ES_PESO_VARIABLE ? 'S' : 'N';
        $guardar->IMPRIMIR_COMP = $request->ES_PESO_VARIABLE ? 'S' : 'N';
        $guardar->PERMITIR_AGREGAR_COMP = $request->ES_PESO_VARIABLE ? 'S' : 'N';

        $guardar->IMPRIMIR_NOTAS_COMPRAS = $request->IMPRIMIR_NOTAS_COMPRAS ? 'S' : 'N';
        $guardar->IMPRIMIR_NOTAS_VENTAS = $request->IMPRIMIR_NOTAS_VENTAS ? 'S' : 'N';
        $guardar->NOTAS_COMPRAS = $request->NOTAS_COMPRAS;
        $guardar->NOTAS_VENTAS = $request->NOTAS_VENTAS;
        $guardar->LINEA_ARTICULO_ID = $request->LINEA_ARTICULO_ID;


        $guardar->DIAS_GARANTIA = $request->DIAS_GARANTIA;
        $guardar->CUENTA_ALMACEN = $request->CUENTA_ALMACEN;
        $guardar->CUENTA_COSTO_VENTA = $request->CUENTA_COSTO_VENTA;
        $guardar->CUENTA_DEVOL_VENTAS = $request->CUENTA_DEVOL_VENTAS;
        $guardar->ALMACEN_ID = $request->ALMACEN_ID;
        $guardar->LOCALIZACION = $request->LOCALIZACION;
        $guardar->INVENTARIO_MAXIMO = $request->INVENTARIO_MAXIMO;
        $guardar->PUNTO_REORDEN = $request->PUNTO_REORDEN;
        $guardar->INVENTARIO_MINIMO = $request->INVENTARIO_MINIMO;
        $guardar->save();







        foreach ($request->claves as $clave) {
            $guardarclave = new ClaveArticulo();
            $guardarclave->CLAVE_ARTICULO = $clave['clavearticulo'];
            $guardarclave->ARTICULO_ID = $guardar->ARTICULO_ID;
            $guardarclave->ROL_CLAVE_ART_ID = $clave['rol'];
            $guardarclave->CONTENIDO_EMPAQUE = 1;
            $guardarclave->save();
        }


        foreach ($request->clasificadores as $clasificador) {
            $guardarclasificador = new ClasificadorCatValor();

            $guardarclasificador->CLASIFICADOR_ID = $clasificador['clasificador'];
            $guardarclasificador->VALOR = $clasificador['valor'];
            $guardarclasificador->POSICION = 1;
            $guardarclasificador->Save();
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
        $articulo = Articulo::with('relacion_linea_de_articulos')->find($id);
        $articulo->SEGUIMIENTO = $articulo->SEGUIMIENTO == 'S' ? true : false;
        $articulo->ES_IMPORTADO = $articulo->ES_IMPORTADO == 'S' ? true : false;
        $articulo->ES_SIEMPRE_IMPORTADO = $articulo->ES_SIEMPRE_IMPORTADO == 'S' ? true : false;
        $articulo->IMPRIMIR_NOTAS_COMPRAS = $articulo->IMPRIMIR_NOTAS_COMPRAS == 'S' ? true : false;
        $articulo->ES_PRECIO_VARIABLE = $articulo->ES_PRECIO_VARIABLE == 'S' ? true : false;
        $articulo->APLICAR_FACTOR_VENTA = $articulo->APLICAR_FACTOR_VENTA == 'S' ? true : false;
        $articulo->RED_PRECIO_CON_IMPTO = $articulo->RED_PRECIO_CON_IMPTO== 'S' ? true : false;
        $articulo->ES_ALMACENABLE = $articulo->ES_ALMACENABLE== 'S' ? true : false;
        

        $lineasarticulos = LineaArticulo::all();
        $unidadesventa = UnidadVenta::select('UNIDAD_VENTA_ID', 'UNIDAD_VENTA')->where('is_active', '=', 1)->get();
        $almacenes = Almacen::select('ALMACEN_ID', 'NOMBRE')->where('is_active', '=', 1)->get();
        $rolarticulos = RolClaveArticulo::select('ROL_CLAVE_ART_ID', 'NOMBRE')->where('is_active', '=', 1)->get();
        $cuentasco = Cuentaco::select('CUENTA_ID', 'NOMBRE', 'SUBCUENTA')->where('is_active', '=', 1)->get();
        $sucursales = Sucursal::select('SUCURSAL_ID', 'NOMBRE')->where('is_active', '=', 1)->get();
        $clasificadorescat = ClasificadorCat::select('CLASIFICADOR_ID', 'NOMBRE')->where('is_active', '=', 1)->get();
        

        return Inertia::render('Inventory/Articulos/Edit', ['articulo' => $articulo,'clasificadorescat'=>$clasificadorescat,'sucursales'=>$sucursales,'cuentasco'=>$cuentasco,'rolarticulos'=>$rolarticulos,'almacenes'=>$almacenes,'unidadesventa'=>$unidadesventa,'lineasarticulos'=>$lineasarticulos,]);
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


    public function export(Request $request)
    {
        return Excel::download(new PaisesExport($request), 'Paises.xlsx');
    }


    public function pdf(Request $request)
    {
        $paises = Articulo::find($request);
        $pdf = PDF::loadView('pdf.paises', compact('paises'));
        return $pdf->stream();
    }
}
