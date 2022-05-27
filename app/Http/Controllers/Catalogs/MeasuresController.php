<?php

namespace App\Http\Controllers\Catalogs;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Measure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MeasuresController extends Controller
{
    public function index()
    {
        $measures = Measure::all();
        return Inertia::render('Catalogs/Measures/Index')->with(compact('measures'));
    }


    public function create()
    {
        return Inertia::render('Catalogs/Measures/Create');
    }

    public function store(Request $request)
    {
        Measure::create(
            $request->validate(
                [
                    'name' => ['required', 'max:50'],
                ]
            )
        );

        return Redirect::route('catalogs.measures.index');
    }

    public function show($id)
    {
        $measure = Measure::find($id);

        return Inertia::render('Catalogs/Measures/Show', ['measure' => $measure]);
    }

    public function edit($id)
    {
        $measure = Measure::find($id);

        return Inertia::render('Catalogs/Measures/Edit', ['measure' => $measure]);
    }

    public function update(Request $request)
    {
        Measure::where('is_active', 1)
            ->where('id', $request->id)
            ->update($request->validate(
                [
                    'id' => ['required'],
                    'name' => ['required', 'min:1', 'max:50'],
                ]
            ));

        return Redirect::route('catalogs.measures.index');
    }

    public function destroy($id)
    {
        $measure = Measure::find($id);
        $measure->is_active = !$measure->is_active;
        $measure->save();

        return Redirect::route('catalogs.measures.index');
    }
}
