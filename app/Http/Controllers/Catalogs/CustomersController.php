<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Models\Term;
use App\Models\PaymentMethod;
use App\Models\TypeOfCoin;
use App\Models\Bank;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return Inertia::render('Catalogs/Customers/Index')->with(compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $getTerms =Term::where('is_active',1)->get();
        $getPaymentMethods=PaymentMethod::where('is_active',1)->get();
        $getTypeOfCoins=TypeOfCoin::where('is_active',1)->get();
        $getBanks=Bank::where('is_active',1)->get();
        return Inertia::render('Catalogs/Customers/Create')->with(compact('getTerms','getPaymentMethods','getTypeOfCoins','getBanks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        


        $saveCustomer = new Customer();
        $saveCustomer->name=$request->name;
        $saveCustomer->rfc=$request->rfc;
        $saveCustomer->address=$request->address;
        $saveCustomer->suburb=$request->suburb;
        $saveCustomer->zip_code=$request->zip_code;
        $saveCustomer->city=$request->city;
        $saveCustomer->polity=$request->polity;
        $saveCustomer->country=$request->country;
        $saveCustomer->turn=$request->turn;
        $saveCustomer->phone=$request->phone;
        $saveCustomer->email=$request->email;
        $saveCustomer->id_terms=$request->id_terms;
        $saveCustomer->id_payment_methods=$request->id_payment_methods;
        $saveCustomer->id_type_of_coins=$request->id_type_of_coins;
        $saveCustomer->id_banks=$request->id_banks;
        $saveCustomer->invoice_portal=$request->invoice_portal;
        $saveCustomer->user=$request->user;
        $saveCustomer->password=$request->password;
        $saveCustomer->iva=$request->iva;
        $saveCustomer->moroso=$request->moroso;
        $saveCustomer->po=$request->po;
      $saveCustomer->is_active=1;

      $saveCustomer->save();

      return Redirect::route('customers.index');
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
