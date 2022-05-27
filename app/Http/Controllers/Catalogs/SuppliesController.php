<?php

namespace App\Http\Controllers\Catalogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\InventoryItemEntry;
use App\Models\Measure;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SuppliesController extends Controller
{
    public function index()
    {
        $supplies = Supply::all();
        return Inertia::render('/Catalogs/Supplies/Index')->with(compact('supplies'));
    }


    public function create()
    {
        $measures = Measure::where('is_active',1)->get();    
        return Inertia::render('Catalogs/Supplies/Create')->with(compact(['measures']));
    }

    public function store(Request $request)
    {
        $supply = Supply::create(
            $request->validate(
                [
                    'name' => ['required', 'max:50'],
                    'id_measure' => ['required', 'max:50'],
                ]
            )
        );
        $inventory = new Inventory();
        $inventory->id_supply = $supply->id; 
        $inventory->min = $request->min;
        $inventory->max = $request->max;
        $inventory->is_active = 1;
        $inventory->save();
        return Redirect::route('catalogs.supplies.index');
    }

    public function show($id)
    {
        $supplie = Supply::find($id);

        return Inertia::render('Catalogs/Supplies/Show', ['supplie' => $supplie]);
    }

    public function edit($id)
    {
        $supplie = Supply::find($id);

        return Inertia::render('Catalogs/Supplies/Edit', ['supplie' => $supplie]);
    }

    public function update(Request $request)
    {
        Supply::where('is_active', 1)
            ->where('id', $request->id)
            ->update($request->validate(
                [
                    'id' => ['required'],
                    'name' => ['required', 'min:1', 'max:50'],
                    'id_measure' => ['required', 'integer', 'min:1', 'max:50'],
                ]
            ));

        return Redirect::route('catalogs.supplies.index');
    }

    public function destroy($id)
    {
        $supplie = Supply::find($id);
        $supplie->is_active = !$supplie->is_active;
        $supplie->save();

        return Redirect::route('catalogs.supplies.index');
    }
}
