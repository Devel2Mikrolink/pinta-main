<?php

namespace App\Exports;

use App\Models\GrupoLinea;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Log;

class GruposLineasExport implements FromView
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
       
        return view('exports.gruposlineas', [
            'gruposlineas' =>GrupoLinea::find($this->request)
        ]);
    }
}
