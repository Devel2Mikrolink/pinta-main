<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        return Inertia::render('Catalogs/Locations/Index')->with(compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Catalogs/Locations/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $saveLocation = new Location();
        $saveLocation->name = $request->name;
        $saveLocation->latitude=$request->latitude;
        $saveLocation->longitude=$request->longitude;
        $saveLocation->address=$request->address;


        $saveLocation->is_active = 1;
        $saveLocation->save();
        return Redirect::route('locations.index');
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
        return Inertia::render('Catalogs/Locations/Edit');
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
        $update = Location::find($id);

        $update->name = $request->name;
        $update->latitude=$request->latitude;
        $update->longitude=$request->longitude;
        $update->address=$request->address;
        
        $update->save();
        return Redirect::route('locations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getServices =Location::find($id);
        $getServices ->is_active = !$getServices ->is_active;
        $getServices->save();

        return Redirect::route('locations.index');
    }
}
