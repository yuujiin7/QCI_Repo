<?php

namespace App\Http\Controllers;

use App\Models\ServiceReport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePDF()
    {
        $data = ServiceReport::all();


        $pdf = PDF::loadView('service_report.generate-sr-form', $data);
        return $pdf->download('SR-', $data->sr_number ,'-', $data->date . '.pdf');
        
    }
}
