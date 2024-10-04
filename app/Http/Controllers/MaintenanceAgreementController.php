<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceAgreement;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use function Ramsey\Uuid\v1;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MaintenanceAgreementsImport;

class MaintenanceAgreementController extends Controller
{

    public function index()
    {

        $data = MaintenanceAgreement::all();
        return view('maintenance_agreement.index', ['maintenance_agreements' => $data])->with('title', 'MA List');
    }

    public function show($id)
    {
        $data = MaintenanceAgreement::find($id);
        return view('maintenance_agreement.edit', ['maintenance_agreements' => $data]);
    }

    public function create()
    {

        return view('maintenance_agreement.create')->with('title', 'Create MA');
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'serial_number' => 'required',
                'account_manager' => 'required',
                'account_manager_id' => 'nullable',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'distributor' => 'required',
                'PO_number' => 'required|string',
                'date_history' => 'nullable|date',
                'company_name' => 'required',
                'project_name' => 'required',
                'supp_acc_ref' => 'required',
                'service_agreement' => 'required',
                'model_description' => 'required',
                'product_number' => 'nullable|string',
                'service_level' => 'required',
                'location' => 'required',
                'status' => 'nullable|string',
            ]);

            //default value fir account_manager_id
            $validated['account_manager_id'] = 'N/A';

            //default for date_history is the start_date and end_date concatenated
            if (!isset($validated['date_history'])) {
                $validated['date_history'] = $validated['start_date'] . ' - ' . $validated['end_date'];
            }

            // Set status based on end date
            if (!isset($validated['status'])) {
                $validated['status'] = 'active';
                if (strtotime($validated['end_date']) < strtotime(date('Y-m-d'))) {
                    $validated['status'] = 'expired';
                }
            }
            //dd($validated);

            // Create the Maintenance Agreement
            MaintenanceAgreement::create($validated);
            return redirect('/ma-reports')->with('message', 'MA created successfully');
        } catch (\Throwable $th) {
            // Log and display detailed error message
            Log::error('Error creating Maintenance Agreement: ' . $th->getMessage());
            return redirect('/create/ma-report')->withErrors(['message' => 'MA creation failed: ' . $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $validated = $request->validate([
                'serial_number' => 'required',
                'account_manager' => 'required',
                'account_manager_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'distributor' => 'required',
                'PO_number' => 'required',
                'company_name' => 'required',
                'project_name' => 'required',
                'supp_acc_ref' => 'required',
                'service_agreement' => 'required',
                'service_level' => 'required',
                'model_description' => 'required',
                'product_number' => 'required',
                'service_level' => 'required',
                'location' => 'required',
                'status' => 'required',

            ]);
            $validated['id'] = $id;

            $data = MaintenanceAgreement::find($id);
            $data->update($request->all());
            return redirect('/ma-reports')->with('message', 'MA updated successfully');
        } catch (\Throwable $th) {
            return redirect('/ma-reports')->with('message', 'MA update failed');
        }
    }

    public function destroy($id)
    {
        try {
            $data = MaintenanceAgreement::find($id);
            dd($data);
            $data->delete();
            return redirect('/ma-reports')->with('message', 'MA deleted successfully');
        } catch (\Throwable $th) {
            return redirect('/ma-reports')->with('message', 'MA delete failed');
        }
    }

    public function getMaintenanceAgreements(Request $request)
    {
        // Get the request parameters sent by DataTables
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');

        // Base query
        $query = MaintenanceAgreement::query();

        // Apply global search
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('serial_number', 'like', "%{$searchValue}%")
                    ->orWhere('account_manager', 'like', "%{$searchValue}%")
                    ->orWhere('company_name', 'like', "%{$searchValue}%")
                    ->orWhere('status', 'like', "%{$searchValue}%")
                    ->orWhere('location', 'like', "%{$searchValue}%")
                    ->orWhere('service_level', 'like', "%{$searchValue}%")
                    ->orWhere('product_number', 'like', "%{$searchValue}%")
                    ->orWhere('model_description', 'like', "%{$searchValue}%")
                    ->orWhere('service_agreement', 'like', "%{$searchValue}%")
                    ->orWhere('supp_acc_ref', 'like', "%{$searchValue}%")
                    ->orWhere('project_name', 'like', "%{$searchValue}%")
                    ->orWhere('company_name', 'like', "%{$searchValue}%")
                    ->orWhere('PO_number', 'like', "%{$searchValue}%")
                    ->orWhere('distributor', 'like', "%{$searchValue}%");

            });
        }

        // Get the total number of records before filtering
        $totalRecords = MaintenanceAgreement::count();

        // Get the filtered records
        $totalFilteredRecords = $query->count();

        // Apply pagination
        $agreements = $query->skip($start)->take($length)->get();

        // Process the data to calculate remaining days and status
        $agreements->transform(function ($agreement) {
            try {
                $endDate = Carbon::parse($agreement->end_date);
                $now = Carbon::now();

                Log::info('End Date:', ['end_date' => $endDate->toDateString()]);
                Log::info('Current Date:', ['now' => $now->toDateString()]);

                // Calculate remaining days
                $remainingDays = $now->diffInDays($endDate, false); // false for negative if past date
                //rounding off the remaining days
                $remainingDaysRounded = round($remainingDays);
                //make the remaining adjust if its less than 12 months use months and if less than 30 days use days
                if ($remainingDaysRounded < 30) {
                    $remainingDaysFinal = round($now->diffInDays($endDate, false)) . ' days';
                } elseif ($remainingDaysRounded < 365) {
                    $remainingDaysFinal = round($now->diffInMonths($endDate, false)) . ' months';
                } else {
                    $remainingDaysFinal = round($now->diffInYears($endDate, false)) . ' years';
                }

                Log::info('Remaining Days:', ['remaining_days' => $remainingDays]);

                // Determine status and color
                if ($remainingDays >= 0) {
                    $agreement->status = "<span style='color: green;'>Active ({$remainingDaysFinal} remaining)</span>";
                } else {
                    $remainingDays = abs($remainingDays);
                    $agreement->status = "<span style='color: red;'>Expired ({$remainingDaysFinal} ago)</span>";
                }
            } catch (\Exception $e) {
                Log::error('Error processing date:', ['message' => $e->getMessage()]);
                $agreement->status = "<span style='color: red;'>Error</span>";
            }

            return $agreement;
        });

        // Return the response in the format expected by DataTables
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFilteredRecords,
            'data' => $agreements
        ]);
    }

    public function renew(Request $request, $id)
    {
        try {
            // Find the existing maintenance agreement
            $agreement = MaintenanceAgreement::findOrFail($id);

            // Validate the request data
            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            // Decode date_history from JSON string to array
            $dateHistory = json_decode($agreement->date_history, true);
            if (!is_array($dateHistory)) {
                $dateHistory = [];
            }

            // Append previous dates to the date_history
            $dateHistory[] = [
                'start_date' => $agreement->start_date,
                'end_date' => $agreement->end_date,
            ];

            // Update the maintenance agreement with new dates
            $agreement->update([
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'date_history' => json_encode($dateHistory), // Store updated date history
            ]);

            return redirect('/ma-reports')->with('message', 'MA renewed successfully');
        } catch (\Throwable $th) {
            // Log the error message for debugging
            Log::error('Error renewing Maintenance Agreement: ' . $th->getMessage());
            return redirect('/create/ma-report')->with('message', 'MA renewal failed');
        }
    }

    public function exportCsv(Request $request)
    {
        $agreements = MaintenanceAgreement::all(); // Or use pagination if you have many records

        $response = new StreamedResponse(function () use ($agreements) {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'Serial Number',
                'Account Manager',
                'Start Date',
                'End Date',
                'Distributor',
                'PO Number',
                'Company Name',
                'Project Name',
                'Supplementary Account Ref',
                'Service Agreement',
                'Model Description',
                'Product Number',
                'Service Level',
                'Location',
                'Date History',
                'Status',
            ]);

            foreach ($agreements as $agreement) {
                // Convert date history to a string
                $dateHistory = '';
                if ($agreement->date_history) {
                    $dateHistory = implode(', ', array_map(function ($date) {
                        return $date['start_date'] . ' - ' . $date['end_date'];
                    }, json_decode($agreement->date_history, true)));
                }

                fputcsv($handle, [
                    $agreement->serial_number,
                    $agreement->account_manager,
                    $agreement->start_date,
                    $agreement->end_date,
                    $agreement->distributor,
                    $agreement->PO_number,
                    $agreement->company_name,
                    $agreement->project_name,
                    $agreement->supp_acc_ref,
                    $agreement->service_agreement,
                    $agreement->model_description,
                    $agreement->product_number,
                    $agreement->service_level,
                    $agreement->location,
                    $dateHistory,
                    $agreement->status,
                ]);
            }

            fclose($handle);
        });

        // Format the filename with the current date
        $date = now()->format('Y-m-d');
        $filename = "MA-{$date}.csv";

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', "attachment; filename=\"{$filename}\"");

        return $response;
    }

    public function import(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,csv,txt'
        // ]);
    
        // try {
        //     // Import the data
        //     dd($request->file('file'));
        //     Excel::import(new MaintenanceAgreementsImport, $request->file('file'));
        //     // Return success message after the import
        //     return redirect()->back()->with('success', 'Maintenance agreements imported successfully!');
        // } catch (\Exception $e) {
        //     // Log the error and return an error message
        //     Log::error('Error importing maintenance agreements: ' . $e->getMessage());
        //     return redirect()->back()->withErrors(['message' => 'Failed to import maintenance agreements: ' . $e->getMessage()]);
        // }

        // Validate the uploaded file
    $request->validate([
        'file' => 'required|mimes:xlsx,csv', // Ensure it's either an Excel or CSV file
    ]);

    // Check if the file is uploaded
    if ($request->hasFile('file')) {
        $file = $request->file('file');

        // Try importing the file
        try {
            Excel::import(new MaintenanceAgreementsImport, $file);

            return redirect()->back()->with('success', 'Maintenance Agreements imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error during import: ' . $e->getMessage());
        }
    }

    return redirect()->back()->with('error', 'No file was uploaded.');
    }
}
