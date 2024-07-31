<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceReport;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Database\QueryException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast;

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
        return view('service_report.edit', ['service_report' => $data]);  
    }
    

    public function create(){

        $users = User::all();
        return view('service_report.create', ['user_data' => $users]) -> with('title', 'Create Service Report');
    }

   public function store(Request $request){

        $validated = $request->validate([
            'sr_number' => 'required|min:2|max:255|unique:service_reports,sr_number',
            'event_id' => 'nullable|min:2|max:255|unique:service_reports,event_id',
            'date' => 'required|min:2|max:255',
            'customer_name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'contact_person' => 'required|min:2|max:255',
            'contact_number' => 'nullable|min:2|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
            'total_hours',
            'remarks' => 'nullable|min:2|max:255',
            'new_installation' => 'nullable|boolean',
            'under_maintenance' => 'nullable|boolean',
            'demo_poc' => 'nullable|boolean',
            'billable' => 'nullable|boolean',
            'under_warranty' => 'nullable|boolean',
            'corrective_maintenance' => 'nullable|boolean',
            'add_on' => 'nullable|boolean',
            'others' => 'nullable',
            'is_complete' => 'boolean',
            'machine_model' => 'nullable|min:2|max:255',
            'machine_serial_number' => 'nullable|min:2|max:255|unique:service_reports,machine_serial_number',
            'product_number' => 'nullable|min:2|max:255|unique:service_reports,product_number',
            'part_number' => 'nullable',
            'part_quantity' => 'nullable',
            'part_description' => 'nullable',
            'part_usage' => 'nullable',
            'action_taken' => 'required',
            'pending' => 'nullable',
            'engineer_assigned' => 'min:2|max:255',
            'tech_support' => 'nullable|min:2|max:255',
            'hr_finance' => 'nallable|min:2|max:255',
            'evp_coo' => 'nullable|min:2|max:255',
        ]);

        $validated['hr_finance'] = $validated['hr_finance'] ?? 'Eileen Orence';
        $validated['evp_coo'] = $validated['evp_coo'] ?? 'Rommel Misa';
        $validated['tech_support'] = $validated['tech_support'] ?? 'Julius Caesar Alfaro';
        $validated['is_complete'] = $request->input('is_complete', false ? 0 : 1);
        $validated['engineer_assigned'] = $validated['engineer_assigned'] ?? Auth::user()->first_name . ' ' . Auth::user()->last_name;
        $validated['new_installation'] = $request->input('new_installation', false ? 0 : 1);
        $validated['under_maintenance'] = $request->input('under_maintenance', false ? 0 : 1);
        $validated['demo_poc'] = $request->input('demo_poc', false ? 0 : 1);
        $validated['billable'] = $request->input('billable', false ? 0 : 1);
        $validated['under_warranty'] = $request->input('under_warranty', false);
        $validated['corrective_maintenance'] = $request->input('corrective_maintenance', false ? 0 : 1);
        $validated['add_on'] = $request->input('add_on', false ? 0 : 1);
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

        try {
            ServiceReport::create($validated);
            return redirect('/service-reports')->with('message', 'Service Report created successfully.');
        } catch (QueryException $exception) {
            if ($exception->errorInfo[1] == 1062) { // Duplicate entry error code
                return back()->withErrors(['duplicate' => 'The machine serial number or product number already exists.'])->withInput();
            }
            return back()->withErrors(['error' => 'An error occurred while saving the report.'])->withInput();
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Step 1: Ensure $id is cast to integer explicitly\
            $id = intval($id);
            // dd($id);
            
            // Log the $id to verify
            Log::info('Casting $id to integer: ' . $id);
            // Log the incoming request data for debugging
            Log::info('Request data: ' . json_encode($request->all()));
            
            // Step 2: Validate input data
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
                'total_hours' => 'nullable|numeric',
                'remarks' => 'nullable|min:2|max:255',
                'new_installation' => 'nullable|boolean',
                'under_maintenance' => 'nullable|boolean',
                'demo_poc' => 'nullable|boolean',
                'billable' => 'nullable|boolean',
                'under_warranty' => 'nullable|boolean',
                'corrective_maintenance' => 'nullable|boolean',
                'add_on' => 'nullable|boolean',
                'others' => 'nullable',
                'is_complete' => 'boolean',
                'machine_model' => 'nullable|min:2|max:255',
                'machine_serial_number' => [
                    'nullable',
                    'min:2',
                    'max:255',
                    Rule::unique('service_reports')->ignore($id),
                ],
                'product_number' => [
                    'nullable',
                    'min:2',
                    'max:255',
                    Rule::unique('service_reports')->ignore($id),
                ],
                'part_number' => 'nullable',
                'part_quantity' => 'nullable|integer',
                'part_description' => 'nullable',
                'part_usage' => 'nullable',
                'action_taken' => 'required',
                'pending' => 'nullable',
                'engineer_assigned' => 'min:2|max:255',
                'tech_support' => 'nullable|min:2|max:255',
                'hr_finance' => 'nullable|min:2|max:255',
                'evp_coo' => 'nullable|min:2|max:255',
            ]);
    
            // Step 3: Find the service report or handle ModelNotFoundException
            $serviceReport = ServiceReport::findOrFail($id);
            // dd($serviceReport);
            Log::info('Service Report retrieved: ' . $serviceReport);
    
            // Step 4: Additional logic and updates
            // Ensure default values or calculations are done properly

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
    
            // Handle image upload if needed
            if ($request->hasFile('sr_image')) {
                $request->validate([
                    'sr_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                ]);
    
                $filenameWithExtension = $request->file('sr_image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
                $extension = $request->file('sr_image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    
                // Store original image
                $request->file('sr_image')->storeAs('public/sr_images', $fileNameToStore);
    
                // Create and save thumbnail
                $thumbnailFileNameToStore = 'thumbnail_' . $fileNameToStore;
                $thumbnailPath = 'public/sr_images/thumbnail/' . $thumbnailFileNameToStore;
                $request->file('sr_image')->storeAs('public/sr_images/thumbnail', $thumbnailFileNameToStore);
    
                // Assuming createThumbnail function exists to resize image
                $this->createThumbnail(storage_path('app/' . $thumbnailPath), 150, 93);
    
                // Update form fields with image paths
                $validated['sr_image'] = $fileNameToStore;
            }
    
            // Perform the update
            // dd($validated);
            $serviceReport->update($validated);
            return redirect('/service-reports')->with('success', 'Service Report updated successfully.');
    
        } catch (ModelNotFoundException $e) {
            Log::error('Service report not found: ' . $e->getMessage());
            return back()->with(['message' => 'Service report not found.'])->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating service report: ' . $e->getMessage());
            return back()->with(['message' => 'An error occurred while updating the service report.'])->withInput();
        }
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
