<?php

namespace App\Http\Controllers\Catalogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return Inertia::render('/Catalogs/Suppliers/Index')->with(compact('suppliers'));
    }

    public function create()
    {
        return Inertia::render('Catalogs/Suppliers/Create');
    }

    public function store(Request $request)
    {
        Supplier::create(
            $request->validate(
                [
                    'name' => ['required', 'max:50'],
                    'address' => ['max:50'],
                    'responsable' => ['required', 'max:50'],
                    'phone_number' => ['max:50'],
                ]
            )
        );
        
        return Redirect::route('catalogs.suppliers.index');
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        return Inertia::render('Catalogs/Suppliers/Show', ['supplier' => $supplier]);
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);

        return Inertia::render('Catalogs/Suppliers/Edit', ['supplier' => $supplier]);
    }

    public function update(Request $request)
    {
        Supplier::where('is_active', 1)
            ->where('id', $request->id)
            ->update($request->validate(
                [
                    'id' => ['required'],
                    'name' => ['required', 'min:1', 'max:50'],
                    'address' => ['required',  'max:50'],
                    'responsable' => ['required', 'min:1', 'max:50'],
                    'phone_number' => ['required', 'min:1', 'max:50'],
                ]
            ));

        return Redirect::route('catalogs.suppliers.index');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->is_active = !$supplier->is_active;
        $supplier->save();

        return Redirect::route('catalogs.suppliers.index');
    }
}
