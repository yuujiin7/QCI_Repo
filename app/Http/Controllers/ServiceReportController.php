<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceReport;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;
use App\Models\User;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $users = User::all();

        return view('service_report.create', ['user_data' => $users]) -> with('title', 'Create Service Report');
    }

   public function store(Request $request){

        $validated = $request->validate([
            'sr_number' => 'required|min:2|max:255',
            'event_id' => 'nullable|min:2|max:255',
            'date' => 'required|min:2|max:255',
            'customer_name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'contact_person' => 'required|min:2|max:255',
            'contact_number' => 'nullable|min:2|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_hours' => 'required',
            'remarks' => 'nullable|min:2|max:255',
            'new_installation' => 'nullable|boolean',
            'under_maintenance' => 'nullable|boolean',
            'demo_poc' => 'nullable|boolean',
            'billable' => 'nullable|boolean',
            'under_warranty' => 'nullable|boolean',
            'corrective_maintenance' => 'nullable|boolean',
            'add_on' => 'nullable|boolean',
            'others' => 'nullable',
            'is_complete' => 'nullable|boolean',
            'machine_model' => 'nullable|min:2|max:255',
            'machine_serial_number' => 'nullable|min:2|max:255|unique:service_reports,machine_serial_number',
            'product_number' => 'nullable|min:2|max:255|unique:service_reports,product_number',
            'part_number' => 'nullable',
            'part_quantity' => 'nullable',
            'part_description' => 'nullable',
            'part_usage' => 'nullable',
            'action_taken' => 'required',
            'pending' => 'nullable',
            'engineer_assigned' => 'required',
            'tech_support' => 'nullable|min:2|max:255',
            'hr_finance' => 'nallable|min:2|max:255',
            'evp_coo' => 'nullable|min:2|max:255',
        ]);

        $validated['hr_finance'] = $validated['hr_finance'] ?? 'Eileen Orence';
        $validated['evp_coo'] = $validated['evp_coo'] ?? 'Rommel Misa';
        $validated['tech_support'] = $validated['tech_support'] ?? 'Julius Caesar Alfaro';
        $validated['is_complete'] = $validated['is_complete'] ?? false;
        $validated['new_installation'] = $validated['new_installation'] ?? false;
        $validated['under_maintenance'] = $validated['under_maintenance'] ?? false;
        $validated['demo_poc'] = $validated['demo_poc'] ?? false;
        $validated['billable'] = $validated['billable'] ?? false;
        $validated['under_warranty'] = $validated['under_warranty'] ?? false;
        $validated['corrective_maintenance'] = $validated['corrective_maintenance'] ?? false;
        $validated['add_on'] = $validated['add_on'] ?? false;
        $validated['others'] = $validated['others'] ?? '';
    

        // compute total hours from start and end time
        $start_time = strtotime($validated['start_time']);
        $end_time = strtotime($validated['end_time']);
        $total_hours = ($end_time - $start_time) / 3600;
        $validated['total_hours'] = $total_hours;
        // dd($validated);

    
        if ($request->hasFile('sr_image')) {
            $request->validate([
                'sr_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);
    
            $filenameWithExtension = $request->file('sr_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('sr_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $thumbnailFileNameToStore =  $fileNameToStore;
    
            // Store original image
            $request->file('sr_image')->storeAs('public/sr_images', $fileNameToStore);
    
            // Create and save thumbnail
            $thumbnailPath = 'public/sr_images/thumbnail/' . $thumbnailFileNameToStore;
            $request->file('profile_image')->storeAs('public/sr_images/thumbnail', $thumbnailFileNameToStore);
    
            $this->createThumbnail(storage_path('app/' . $thumbnailPath), 150, 93);
    
            // Update form fields with image paths
            $validated['sr_image'] = $fileNameToStore;
        }

        // dd($validated);
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
            'contact_number' => 'nullable|min:2|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_hours',
            'remarks' => 'nullable|min:2|max:255',
            'new_installation' => 'sometimes|boolean',
            'under_maintenance' => 'sometimes|boolean',
            'demo_poc' => 'sometimes|boolean',
            'billable' => 'sometimes|boolean',
            'under_warranty' => 'sometimes|boolean',
            'corrective_maintenance' => 'sometimes|boolean',
            'add_on' => 'sometimes|boolean',
            'others' => 'nullable|min:2|max:255',
            'is_complete' => 'nullable|boolean',
            'machine_model' => 'nullable|min:2|max:255',
            'machine_serial_number' => 'nullable|min:2|max:255',
            'product_number' => 'nullable|min:2|max:255',
            'part_number' => 'nullable',
            'part_quantity' => 'nullable',
            'part_description' => 'nullable',
            'part_usage' => 'nullable',
            'action_taken' => 'required',
            'pending' => 'nullable',
            'engineer_assigned' => 'min:2|max:255',
            'tech_support' => 'nullable|min:2|max:255',
            'hr_finance' => 'nullable|min:2|max:255',
            'evp_coo' => 'nullable|min:2|max:255',
            'sr_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        
        $validated['hr_finance'] = $validated['hr_finance'] ?? 'Eileen Orence';
        $validated['evp_coo'] = $validated['evp_coo'] ?? 'Rommel Misa';
        $validated['tech_support'] = $validated['tech_support'] ?? 'Julius Caesar Alfaro';
        $validated['is_complete'] = $request->input('is_complete', false);
        $validated['engineer_assigned'] = $validated['engineer_assigned'] ?? Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $validated['new_installation'] = $request->input('new_installation', false);
        $validated['under_maintenance'] = $request->input('under_maintenance', false);
        $validated['demo_poc'] = $request->input('demo_poc', false);
        $validated['billable'] = $request->input('billable', false);
        $validated['under_warranty'] = $request->input('under_warranty', false);
        $validated['corrective_maintenance'] = $request->input('corrective_maintenance', false);
        $validated['add_on'] = $request->input('add_on', false);
        $validated['others'] = $validated['others'] ?? '';
        
       // Calculate total hours if not provided
        if (!isset($validated['total_hours'])) {
            $start_time = strtotime($validated['start_time']);
            $end_time = strtotime($validated['end_time']);
            $total_hours = ($end_time - $start_time) / 3600;
            $validated['total_hours'] = $total_hours;
            $request->merge(['total_hours' => $total_hours]);
        }
  
        
        if ($request->hasFile('sr_image')) {
            $request->validate([
                'sr_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);
    
            $filenameWithExtension = $request->file('sr_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('sr_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $thumbnailFileNameToStore =  $fileNameToStore;
    
            // Store original image
            $request->file('sr_image')->storeAs('public/sr_images', $fileNameToStore);
    
            // Create and save thumbnail
            $thumbnailPath = 'public/sr_images/thumbnail/' . $thumbnailFileNameToStore;
            $request->file('profile_image')->storeAs('public/sr_images/thumbnail', $thumbnailFileNameToStore);
    
            $this->createThumbnail(storage_path('app/' . $thumbnailPath), 150, 93);
    
            // Update form fields with image paths
            $validated['sr_image'] = $fileNameToStore;
        }
        // make machine serial Number and product number and engineer assigned both accept the same value if it is the same
        
         dd($validated);

        $service_report->update($validated);
        //dd($service_report);
        return redirect('/service-reports')->with('message', 'Service Report updated successfully.');
    }


    
    public function destroy($id)
    {
        $service_report = ServiceReport::findOrFail($id);
        $service_report->delete();
        return redirect('/service-reports')->with('message', 'Service Report deleted successfully.');

   }



   public function createThumbnail($path, $width, $height)
    {
        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($path);
            $image->scale($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            // dd($image);
            $image->save($path);
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            Log::error('Error creating thumbnail: ' . $e->getMessage());
        }
        
    }


}
