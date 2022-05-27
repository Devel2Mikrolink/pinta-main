<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => true]);
Route::get('/', "PublicController@index");
Route::get('/about', "HomeController@about");

Route::group(['middleware' => 'auth'], function () {

  

   //Recurso services
   Route::resource('services', Catalogs\ServicesController::class)->names('services');

   //Recurso currencies
   Route::resource('currencies', Catalogs\TypeOfCoinsController::class)->names('currencies');

   //Recurso locations
   Route::resource('locations', Catalogs\LocationsController::class)->names('locations');

   //recurso Customer
   Route::resource('customers', Catalogs\CustomersController::class)->names('customers');

   
   //recurso Method payment
   Route::resource('paymentmethods', Accounting\PaymentMethodsController::class)->names('paymentmethods');

   //recurso BillRetalations
   
   Route::resource('billrelations', Accounting\BillRelationsController::class)->names('billrelations');
//recurso BillCfdiUses


Route::resource('billcfdiuses', Accounting\BillCfdiUsesController::class)->names('billcfdiuses');

//Recurso WayToPays

Route::resource('waytopays', Accounting\WayToPaysController::class)->names('waytopays');

   //Aqui se difinira la ruta tipo resource para modules en donde se podra mirar la vista donde se deve de escoger que modulo entrar
   Route::resource('inventorys', Inventory\InventoryController::class)->names('inventorys');



   //Recurso de inventarios aqui se vera la vista de los inventarios *************************************************


   //recurso para paises
   Route::post('paises/pdf/', 'Inventory\PaisesController@pdf')->name('pdf.paises');
   Route::post('paises/export/', 'Inventory\PaisesController@export')->name('exel.paises');
   Route::resource('paises', Inventory\PaisesController::class)->names('paises');


   //Recurso para estados
   Route::post('estados/pdf/', 'Inventory\EstadosController@pdf')->name('pdf.estados');
   Route::post('estados/export/', 'Inventory\EstadosController@export')->name('exel.estados');
   Route::resource('estados', Inventory\EstadosController::class)->names('estados');

   //Recurso para ciudades
   Route::post('ciudades/pdf/', 'Inventory\CiudadesController@pdf')->name('pdf.ciudades');
   Route::post('ciudades/export/', 'Inventory\CiudadesController@export')->name('exel.ciudades');
   Route::resource('ciudades', Inventory\CiudadesController::class)->names('ciudades');
   

   //recurso lugares de expedicion
   
   Route::post('lugaresExpedicion/pdf/', 'Inventory\LugaresExpedicionController@pdf')->name('pdf.lugaresExpedicion');
   Route::post('lugaresExpedicion/export/', 'Inventory\LugaresExpedicionController@export')->name('exel.lugaresExpedicion');
   Route::resource('lugaresExpedicion', Inventory\LugaresExpedicionController::class)->names('lugaresExpedicion');

   //Recurso vias de embarque
   Route::post('viasdeembarque/pdf/', 'Inventory\ViasDeEmbarqueController@pdf')->name('pdf.viasdeembarque');
   Route::post('viasdeembarque/export/', 'Inventory\ViasDeEmbarqueController@export')->name('exel.viasdeembarque');
   Route::get('indexCompras', 'Inventory\ViasDeEmbarqueController@indexCompras')->name('indexCompras');
   Route::post('viasdeembarque/store/{root}', 'Inventory\ViasDeEmbarqueController@store')->name('viasdeembarque.store');
   Route::resource('viasdeembarque', Inventory\ViasDeEmbarqueController::class)->names('viasdeembarque')->except(['store']);

   //Recurso para almacenes
   Route::post('almacenes/pdf/', 'Inventory\AlmacenesController@pdf')->name('pdf.almacenes');
   Route::post('almacenes/export/', 'Inventory\AlmacenesController@export')->name('exel.almacenes');
   Route::resource('almacenes', Inventory\AlmacenesController::class)->names('almacenes');

   //Recurso Grupo Lineas
   Route::post('gruposlineas/pdf/', 'Inventory\GruposLineasController@pdf')->name('pdf.gruposlineas');
   Route::post('gruposlineas/export/', 'Inventory\GruposLineasController@export')->name('exel.gruposlineas');
   Route::resource('gruposlineas', Inventory\GruposLineasController::class)->names('gruposlineas');

   //Recurso para lienas de articulos 
   Route::post('lineasarticulos/pdf/', 'Inventory\LineasArticulosController@pdf')->name('pdf.lineasarticulos');
   Route::post('lineasarticulos/export/', 'Inventory\LineasArticulosController@export')->name('exel.lineasarticulos');
   Route::resource('lineasarticulos', Inventory\LineasArticulosController::class)->names('lineasarticulos');

//RecursoClasificadodres de articulos
Route::resource('clasificadoresdearticulos', Inventory\ClasificadoresDeArticulosController::class)->names('clasificadoresdearticulos');
   
//Recurso centro de costos
Route::post('centrodecostos/pdf/', 'Inventory\CentroDeCostosController@pdf')->name('pdf.centrodecostos');
Route::post('centrodecostos/export/', 'Inventory\CentroDeCostosController@export')->name('exel.centrodecostos');
Route::resource('centrodecostos', Inventory\CentroDeCostosController::class)->names('centrodecostos');
   

//Recurso Articulos
   Route::post('articulos/pdf/', 'Inventory\ArticulosController@pdf')->name('pdf.articulos');
   Route::post('articulos/export/', 'Inventory\ArticulosController@export')->name('exel.articulos');
   Route::resource('articulos', Inventory\ArticulosController::class)->names('articulos');
   

//Recurso concepto in
Route::post('conceptoin/pdf/', 'Inventory\ConceptoInController@pdf')->name('pdf.conceptoin');
Route::post('conceptoin/export/', 'Inventory\ConceptoInController@export')->name('exel.conceptoin');
Route::resource('conceptoin', Inventory\ConceptoInController::class)->names('conceptoin');


   //Recurso Existencia y valor de inventarios


Route::resource('existenciayvalordeinventarios', Inventory\ExistenciaYValorInventariosController::class)->names('existenciayvalordeinventarios');


//Recurso situacion del inventario

Route::resource('situaciondelinventario', Inventory\SituacionDelInventarioController::class)->names('situaciondelinventario');

//Recurso rotacion del inventario
Route::resource('rotaciondelinventario', Inventory\RotacionDelInventarioController::class)->names('rotaciondelinventario');
//Recurso kardex del inventario
Route::resource('kardexdelinventario', Inventory\KardexDelInventarioController::class)->names('kardexdelinventario');

//Recurso Relaciones del inventario

Route::resource('relacionesdelinventario', Inventory\RelacionesDelInventarioController::class)->names('relacionesdelinventario');


//Recurso Diarios del inventario

Route::resource('diariosdelinventario', Inventory\DiariosDelInventarioController::class)->names('diariosdelinventario');

//Recurso Resultado del inventario fisico

Route::resource('resultadodelinventariofisico', Inventory\ResultadoDelInventarioFisicoController::class)->names('resultadodelinventariofisico');

//Recurso Requerimientos de componentes
Route::resource('requerimientosdecomponentes', Inventory\RequerimientosDeComponentesController::class)->names('requerimientosdecomponentes');

//Recurso Consumos Por centro de costos
Route::resource('consumosporcentrodecostos', Inventory\ConsumosPorCentrosDeCostosController::class)->names('consumosporcentrodecostos');

//Recurso lotes del area de inventarios
Route::resource('lotes', Inventory\LotesController::class)->names('lotes');

//Recurso numeros de serie
Route::resource('numerosdeseries', Inventory\NumerosDeSerieController::class)->names('numerosdeseries');

//Recurso Pedimentos De Importacón
Route::resource('pedimentosdeimportacion', Inventory\PedimentosDeImportacionController::class)->names('pedimentosdeimportacion');

//Recurso Capas costos
Route::resource('capascostos', Inventory\CapasCostosController::class)->names('capascostos');

//Recurso Cambiar Periodo
Route::resource('cambiarperiodo', Inventory\CambiarPeriodoController::class)->names('cambiarperiodo');

//Recurso Recalcular costos
Route::resource('recalcularcostos', Inventory\RecalcularCostosController::class)->names('recalcularcostos');

//Recurso Crear polizas contables
Route::resource('crearpolizascontables', Inventory\CrearPolizasContablesController::class)->names('crearpolizascontables');

//Recurso Reasignar pedimentos de importacion
Route::resource('reasignarpedimentosdeimportacion', Inventory\ReasignarPedimentosDeImportacionController::class)->names('reasignarpedimentosdeimportacion');

//Recurso Perfiles de dias de inventarios
Route::resource('perfilesdediasdeinventarios', Inventory\PerfilesDeDiasDeInventariosController::class)->names('perfilesdediasdeinventarios');

//Recurso Dias de inventarios de los articulos
Route::resource('diasdeinventariosdelosarticulos', Inventory\DiasDeIventarioDeLosArticulosController::class)->names('diasdeinventariosdelosarticulos');

//Recurso Calcular niveles del inventario
Route::resource('calcularnivelesdelinventario', Inventory\CalcularNivelesDelInventarioController::class)->names('calcularnivelesdelinventario');

//Recurso Unidades de medidas de los articulos
Route::resource('unidadesdemedidasdelosarticulos', Inventory\UnidadesDeMedidasDeLosArticulosController::class)->names('unidadesdemedidasdelosarticulos');

//Recurso Conceptos autorizados por usuarios
Route::resource('conceptosautorizadoporusuario', Inventory\ConceptosAutorizadosPorUsuarioController::class)->names('conceptosautorizadoporusuario');

//Recurso Recalcular saldos y existencias
Route::resource('recalcularsaldosyexistencias', Inventory\RecalcularSaldosYExistenciasController::class)->names('recalcularsaldosyexistencias');

//Recurso Inicializar el inventario
Route::resource('inicializarelinventario', Inventory\InicializarElInventarioController::class)->names('inicializarelinventario');

//Recurso Coregir datos de pedimentos
Route::resource('corregirdatosdepedimentos', Inventory\CoregirDatosDePedimentosController::class)->names('corregirdatosdepedimentos');
//Recurso Preferencias de la empresa
Route::resource('preferenciasdelaempresa', Inventory\PreferenciasDeLaEmpresaController::class)->names('preferenciasdelaempresa');

//Recurso Asignar clave sat de los articulos
Route::resource('asignarclavesatdelosarticulos', Inventory\AsignarClaveSatDeLosArticulosController::class)->names('asignarclavesatdelosarticulos');


//Recurso Calculadora
Route::resource('calculadora', Inventory\CalculadoraController::class)->names('calculadora');




//recurso de entras inventarios
Route::resource('entradasinventarios', Inventory\EntradasInventariosController::class)->names('entradasinventarios');
//recurso para salida de inventarios

Route::resource('salidasinventarios', Inventory\SalidasInventariosController::class)->names('salidasinventarios');

//Recurso inventarios fisicos
Route::resource('inventariosfisicos', Inventory\InventariosFisicosController::class)->names('inventariosfisicos');

//Recurso traspaso de sucursales
Route::resource('traspasoentresucursales', Inventory\TraspasosEntreSucursalesController::class)->names('traspasoentresucursales');

//Recuso traslados en inventarios
Route::resource('traslados', Inventory\TrasladosController::class)->names('traslados');

/*
Aqui empiezan los recursos que se utilizara para el modulo de compras
*/

//Recurso proveedores
Route::resource('proveedores', Compras\ProveedoresController::class)->names('proveedores');

//recurso tipos de proveedores
Route::resource('tiposdeproveedores', Compras\TipoProveedoresController::class)->names('tiposdeproveedores');

//Recurso condiciones de pago
Route::resource('condicionesdepago', Compras\CondicionesDePagoController::class)->names('condicionesdepago');


//Recurso Clasificadores cat

Route::resource('clasificadorescat', Compras\ClasificadoresCatController::class)->names('clasificadorescat');

//Recurso Impuesto

Route::resource('impuesto', Compras\ImpuestosController::class)->names('impuesto');

//recurso Tipo de cambio
Route::resource('tiposdecambio', Compras\TiposDeCambioController::class)->names('tiposdecambio');

//recurso monedas
Route::resource('monedas', Compras\MonedasController::class)->names('monedas');

//Recurso de inventarios aqui finaliza el modulo  *************************************************



//Aqui empieza el modulo de contabilidad  *************************************************

//RECURSO CUENTA CONTABLE
Route::resource('cuentascontables', Contabilidad\CuentasContablesController::class)->names('cuentascontables');
Route::resource('beneficiarios', Contabilidad\BeneficiariosController::class)->names('beneficiarios');
Route::resource('gruposdecuentas', Contabilidad\GruposDeCuentasController::class)->names('gruposdecuentas');


//RECURSO ACTIVOS FIJOS

Route::resource('activosfijos', Contabilidad\ActivosFijosController::class)->names('activosfijos');

//Recurso presupuesto
Route::resource('presupuestos', Contabilidad\PresupuestosController::class)->names('presupuestos');

//Recurso presupuesto
Route::resource('cuentasbancarias', Contabilidad\CuentasBancariasController::class)->names('cuentasbancarias');

//Recurso poliza
Route::resource('polizas', Contabilidad\PolizasController::class)->names('polizas');
//Recurso polizas pendientes
Route::resource('polizaspendientes', Contabilidad\PolizasPendientesController::class)->names('polizaspendientes');

//Recurso polizas periodicas
Route::resource('polizasperiodicas', Contabilidad\PolizasPeriodicasContoller::class)->names('polizasperiodicas');




//Aqui Finaliza el modulo de contabilidad  *************************************************
   
});
