<?php

namespace App\Http\Controllers\Inventory;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\InventoryItemEntry;
use App\Models\Supplier;
use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EntryController extends Controller
{
    public function create()
    {
        $supplies = Supply::with('measure')->where('is_active', 1)->get();
        $suppliers = Supplier::where('is_active',1)->get();
        return Inertia::render('Inventory/Entry')->with(compact('suppliers','supplies'));
    }

    public function store(Request $request){

        $entry = new InventoryItemEntry();
      
        $inventory = Inventory::where('id_supply',$request->supply['id'])->first();

        $inventory->quantity = $inventory->quantity + $request->quantity;
        $inventory->save();
        
        
        $inventoryItem = InventoryItem::where('id_supplier',$request->supplier['id'])->where('id_inventory',$inventory->id)->first();
        if($inventoryItem !=null)
        {
            $inventoryItem->quantity = $inventoryItem->quantity + $request->quantity;
            $inventoryItem->save();
        }
        else{
            $inventoryItem = new InventoryItem();
            $inventoryItem->id_inventory = $inventory->id;
            $inventoryItem->id_supplier = $request->supplier['id'];
            $inventoryItem->quantity = $request->quantity;
            $inventoryItem->is_active= 1;
            $inventoryItem->save();
        }

        $entry->id_inventory = $inventory->id;
        $entry->id_supplier = $request->supplier['id'];
        $entry->purchase_price = $request->price;
        $entry->code = $request->code ?? '';
        $entry->quantity = $request->quantity;
        $entry->is_active = 1;
        $entry->save();

        return Redirect::route('inventory.current');
    }
}
