<?php

namespace App\Exports;

use App\Models\Centrocosto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class CentroCostosExport implements FromView
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
       
        return view('exports.centrodecostos', [
            'centrodecostos' =>Centrocosto::find($this->request)
        ]);
    }
}
