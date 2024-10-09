<?php

namespace App\Http\Controllers;

use App\Models\ServiceReport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;




class PdfController extends Controller
{
    public function generatePDF($id)
    {
        $serviceReport = ServiceReport::findOrFail($id);

        // Path to your image file
        $path = public_path('/images/logo.png');

        // Check if file exists and read it
        $base64Image = '';
        if (file_exists($path)) {
            $imageData = file_get_contents($path);
            $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
        }
        // dd($base64Image);

        // make data an array
        $data = [
            'serviceReport' => $serviceReport ?? null,
            'serviceReportId' => $serviceReport->id ?? null,
            'serviceReportNumber' => $serviceReport->sr_number ?? null,
            'date' => $serviceReport->date ?? null,
            'customer' => $serviceReport->customer_name ?? null,
            'contactPerson' => $serviceReport->contact_person ?? null,
            'contactNumber' => $serviceReport->contact_number ?? null,
            'address' => $serviceReport->address ?? null,
            'email' => $serviceReport->email ?? null,
            'machineModel' => $serviceReport->machine_model ?? null,
            'machineSerialNumber' => $serviceReport->machine_serial_number ?? null,
            'model' => $serviceReport->model ?? null,
            'problem' => $serviceReport->problem ?? null,
            'remarks' => $serviceReport->remarks ?? null,
            'technician' => $serviceReport->tech_support ?? null,
            'status' => $serviceReport->status ?? null,
            'eventID' => $serviceReport->event_id ?? null,
            'startTime' => $serviceReport->start_time ?? null,
            'endTime' => $serviceReport->end_time ?? null,
            'totalHours' => $serviceReport->total_hours ?? null,
            'productNumber' => $serviceReport->product_number ?? null,
            'partNumber' => $serviceReport->part_number ?? null,
            'partDescription' => $serviceReport->part_description ?? null,
            'partQuantity' => $serviceReport->part_quantity ?? null,
            'partUsage' => $serviceReport->part_usage ?? null,
            'actionTaken' => $serviceReport->action_taken ?? null,
            'pending' => $serviceReport->pending ?? null,
            'engineerAssigned' => $serviceReport->engineer_assigned ?? null,
            'hrFinance' => $serviceReport->hr_finance ?? null,
            'evpCoo' => $serviceReport->evp_coo ?? null,
            'base64Image' => $base64Image ?? null,
            'new_installation' => $serviceReport->new_installation ?? null,
            'under_maintenance' => $serviceReport->under_maintenance ?? null,
            'demo_poc' => $serviceReport->demo_poc ?? null,
            'billable' => $serviceReport->billable ?? null,
            'under_warranty' => $serviceReport->under_warranty ?? null,
            'corrective_maintenance' => $serviceReport->corrective_maintenance ?? null,
            'add_on' => $serviceReport->add_on ?? null,
            'is_complete' => $serviceReport->is_complete ?? null,
            'others' => $serviceReport->others ?? null,
            'problem_details' => $serviceReport->problem_details ?? null,

        ];

        // dd($data);


        $pdf = Pdf::loadView('service_report.generate-sr-form', $data)
            ->setPaper('a4', 'portrait')
            ->setWarnings(false)
            ->setOptions(['isRemoteEnabled' => true]);

        // dd($pdf);
        return $pdf->stream('SR_' . $serviceReport->sr_number . '_' . $serviceReport->date . '.pdf')
            ->header('Content-Type', 'application/pdf');

        
    }
}
