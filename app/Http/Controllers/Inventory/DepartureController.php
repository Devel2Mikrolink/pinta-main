<?php

namespace App\Http\Controllers\Inventory;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\InventoryItemDeparture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DepartureController extends Controller
{
    public function create()
    {   
        $inventoryItems = InventoryItem::with('inventory')->with('supplier')->get();
        //return $inventoryItems;
        return Inertia::render('Inventory/Departure')->with(['supplies'=>$inventoryItems]);
    }

    public function store(Request $request){
        
        foreach($request->departures as $departure)
        {
            $inventory = Inventory::find($departure['id_inventory']);

            $inventory->quantity = $inventory->quantity - $departure['quantity'];
            $inventory->save();
            
            
            $inventoryItem = InventoryItem::where('id_supplier',$departure['id_supplier'])->where('id_inventory',$departure['id_inventory'])->first();
            if($inventoryItem !=null)
            {
                $inventoryItem->quantity = $inventoryItem->quantity - $departure['quantity'];
                $inventoryItem->save();
            }
            else{
                $inventoryItem = new InventoryItem();
                $inventoryItem->id_inventory = $inventory->id;
                $inventoryItem->id_supplier = $departure['id)supplier'];
                $inventoryItem->quantity = 0-$departure['quantity'];
                $inventoryItem->is_active= 1;
                $inventoryItem->save();
            }

            $inventoryDeparture = new InventoryItemDeparture();
            $inventoryDeparture->id_inventory = $departure['id_inventory'];        
            $inventoryDeparture->id_supplier = $departure['id_supplier'];
            $inventoryDeparture->id_user = Auth::id()?? 0;
            $inventoryDeparture->quantity = $departure['quantity'];        
            $inventoryDeparture->reason = $request->reason;
            $inventoryDeparture->is_active = 1;
            $inventoryDeparture->save();
        }

        return Redirect::route('inventory.current');
        
    }
}
