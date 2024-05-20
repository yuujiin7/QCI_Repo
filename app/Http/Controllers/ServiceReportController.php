<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceReport;


use Illuminate\Http\Request;

class ServiceReportController extends Controller
{
    public function index()
    {

        $data = ServiceReport::all();
      
        return view('service_report.index', ['service_report' => $data]) -> with('title', 'Service Report List');
    }

    public function show($id)
    {
        $data = ServiceReport::findOrFail($id);
        
        // dd($data);
        return view('service_report.edit', ['service_report' => $data]);  
    }
    

    public function create(){
        return view('service-report.create') -> with('title', 'Create Service Report');
    }

   public function store(Request $request){

        $validated = $request->validate([
            'sr_number' => 'required|min:2|max:255',
            'event_id' => 'nullable|min:2|max:255',
            'date' => 'required|min:2|max:255',
            'customer_name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'contact_person' => 'required|min:2|max:255',
            'contact_number' => 'required|min:2|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_hours' => 'required',
            'remarks' => 'required|min:2|max:255',
            'status_1' => 'nullable|min:2|max:255',
            'machine_model' => 'nullable|min:2|max:255|unique:service_reports,machine_model',
            'machine_serial_number' => 'nullable|min:2|max:255|unique:service_reports,machine_serial_number',
            'product_number' => 'nullable|min:2|max:255|unique:service_reports,product_number',
            'part_number' => 'nullable',
            'part_quantity' => 'nullable',
            'part_description' => 'nullable',
            'part_usage' => 'nullable',
            'action_taken' => 'required',
            'pending' => 'required',
            'status_2' => 'required',
            'engineer_assigned' => 'required',
            'tech_support' => 'nullable|min:2|max:255',
            'hr_finance' => 'nallable|min:2|max:255',
            'evp_coo' => 'nullable|min:2|max:255',
        ]);

        ServiceReport::create($validated);
        return redirect('/service-reports')->with('message', 'Service Report created successfully.');
    }

    public function update(Request $request, ServiceReport $service_report)
    {
        $validated = $request->validate([
            'sr_number' => 'required|min:2|max:255',
            'event_id' => 'nullable|min:2|max:255',
            'date' => 'required|min:2|max:255',
            'customer_name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'contact_person' => 'required|min:2|max:255',
            'contact_number' => 'required|min:2|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_hours' => 'required',
            'remarks' => 'required|min:2|max:255',
            'status_1' => 'nullable|min:2|max:255',
            'machine_model' => 'nullable|min:2|max:255|unique:service_reports,machine_model,' . $service_report->id,
            'machine_serial_number' => 'nullable|min:2|max:255|unique:service_reports,machine_serial_number,' . $service_report->id,
            'product_number' => 'nullable|min:2|max:255|unique:service_reports,product_number,' . $service_report->id,
            'part_number' => 'nullable',
            'part_quantity' => 'nullable',
            'part_description' => 'nullable',
            'part_usage' => 'nullable',
            'action_taken' => 'required',
            'pending' => 'required',
            'status_2' => 'required',
            'engineer_assigned' => 'required',
            'tech_support' => 'nullable|min:2|max:255',
            'hr_finance' => 'nullable|min:2|max:255',
            'evp_coo' => 'nullable|min:2|max:255',
        ]);

        $service_report->update($validated);
        return redirect('/service-reports')->with('message', 'Service Report updated successfully.');
    }

    public function destroy(ServiceReport $service_report)
    {
        $service_report->delete();
        return redirect('/service-reports')->with('message', 'Service Report deleted successfully.');

   }


}
