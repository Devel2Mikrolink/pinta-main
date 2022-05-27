<?php

namespace App\Exports;
use App\Models\ConceptoIn;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConceptoinExport implements FromView
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
       
        return view('exports.conceptosin', [
            'conceptosin' =>ConceptoIn::find($this->request)
        ]);
    }
}
