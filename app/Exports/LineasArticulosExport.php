<?php

namespace App\Exports;

use App\Models\LineaArticulo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class LineasArticulosExport implements FromView
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
       
        return view('exports.lineasarticulos', [
            'lineasarticulos' =>LineaArticulo::find($this->request)
        ]);
    }
}
