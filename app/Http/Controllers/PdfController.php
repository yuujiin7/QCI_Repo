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
            'serviceReport' => $serviceReport,
            'serviceReportId' => $serviceReport->id,
            'serviceReportNumber' => $serviceReport->sr_number,
            'date' => $serviceReport->date,
            'customer' => $serviceReport->customer_name,
            'contactPerson' => $serviceReport->contact_person,
            'contactNumber' => $serviceReport->contact_number,
            'address' => $serviceReport->address,
            'email' => $serviceReport->email,
            'machineModel' => $serviceReport->machine_model,
            'machineSerialNumber' => $serviceReport->machine_serial_number,
            'model' => $serviceReport->model,
            'problem' => $serviceReport->problem,
            'remarks' => $serviceReport->remarks,
            'technician' => $serviceReport->tech_support,
            'status' => $serviceReport->status,
            'eventID' => $serviceReport->event_id,
            'startTime' => $serviceReport->start_time,
            'endTime' => $serviceReport->end_time,
            'totalHours' => $serviceReport->total_hours,
            'productNumber' => $serviceReport->product_number,
            'partNumber' => $serviceReport->part_number,
            'partDescription' => $serviceReport->part_description,
            'partQuantity' => $serviceReport->part_quantity,
            'partUsage' => $serviceReport->part_usage,
            'actionTaken' => $serviceReport->action_taken,
            'pending' => $serviceReport->pending,
            'engineerAssigned' => $serviceReport->engineer_assigned,
            'hrFinance' => $serviceReport->hr_finance,
            'evpCoo' => $serviceReport->evp_coo,
            'base64Image' => $base64Image,
            
            

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
