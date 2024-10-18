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

        if (!$data) {
            abort(404, 'Maintenance Agreement not found');
        }

        return view('maintenance_agreement.edit', ['maintenance_agreements' => $data])->with('title', 'Edit MA');
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

            if (!$data) {
                return redirect('/ma-reports')->with('message', 'MA not found');
            }

            $data->delete();
            return redirect('/ma-reports')->with('message', 'MA deleted successfully');
        } catch (\Throwable $th) {
            Log::error('Error deleting MA:', ['error' => $th->getMessage()]);
            return redirect('/ma-reports')->with('message', 'MA delete failed');
        }
    }

    public function delete(Request $request)
    {
        try {
            // Log raw request data
            Log::info('Raw Request Data:', $request->all());

            // Validate the request to ensure 'ids' is an array
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'exists:maintenance_agreements,id', // Ensure each ID exists in the correct table
            ]);

            // Retrieve the IDs from the request and convert them to integers
            $ids = array_map('intval', $request->input('ids'));

            // Log validated IDs
            Log::info('Validated IDs:', $ids);

            // Check which IDs exist in the database (for debugging)
            $existingIds = MaintenanceAgreement::whereIn('id', $ids)->pluck('id')->toArray();
            Log::info('Existing IDs in DB:', $existingIds);

            // Delete the service reports with the given IDs
            MaintenanceAgreement::whereIn('id', $existingIds)->delete();

            // Return a success response
            return response()->json(['success' => true, 'message' => 'Selected reports have been deleted.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::error('Validation error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Log general errors
            Log::error('Deletion error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the reports.'], 500);
        }
    }


    public function getMaintenanceAgreements(Request $request)
    {
        // Base query with eager loading for service reports
        $query = MaintenanceAgreement::with('serviceReports');

        // Get the request parameters sent by DataTables
        $searchValue = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');
        $orderColumnIndex = $request->input('order.0.column'); // Index of the column to order by
        $orderDirection = $request->input('order.0.dir'); // Order direction (asc or desc)

        $columns = [
            'serial_number',
            'account_manager',
            'company_name',
            'status',
            'location',
            'service_level',
            'product_number',
            'model_description',
            'service_agreement',
            'supp_acc_ref',
            'project_name',
            'PO_number',
            'distributor',
            'date_history',
        ];

        $orderColumn = $columns[$orderColumnIndex] ?? 'serial_number'; // Default to 'serial_number' if out of bounds

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
                    ->orWhere('PO_number', 'like', "%{$searchValue}%")
                    ->orWhere('distributor', 'like', "%{$searchValue}%")
                    ->orWhere('date_history', 'like', "%{$searchValue}%");
            });
        }

        // Get the total number of records before filtering
        $totalRecords = MaintenanceAgreement::count();

        // Get the filtered records
        $totalFilteredRecords = $query->count();

        // Apply sorting based on DataTables parameters
        $query->orderBy($orderColumn, $orderDirection);

        // Apply pagination
        $agreements = $query->skip($start)->take($length)->get();

        // Process the data to calculate remaining days and status
        $agreements->transform(function ($agreement) {
            try {
                $endDate = Carbon::parse($agreement->end_date);
                $now = Carbon::now();

                // Calculate remaining days
                $remainingDays = $now->diffInDays($endDate, false); // false for negative if past date
                $remainingDaysRounded = round($remainingDays);

                // Prepare the remaining time format
                if ($remainingDaysRounded < 0) {
                    $remainingDays = abs($remainingDays);
                    if ($remainingDays >= 365) {
                        $remainingDaysFinal = round($remainingDays / 365) . ' year/s';
                    } elseif ($remainingDays >= 30) {
                        $remainingDaysFinal = round($remainingDays / 30) . ' months';
                    } else {
                        $remainingDaysFinal = $remainingDays . ' days';
                    }
                    $agreement->status = "<span style='color: red;'>Expired ({$remainingDaysFinal} ago)</span>";
                } else {
                    if ($remainingDaysRounded <= 180) { // 6 months threshold for renewal
                        $remainingDaysFinal = abs(round($remainingDays / 30)) . ' months';
                        $agreement->status = "<span style='color: orange;'>For Renewal ({$remainingDaysFinal} remaining)</span>";
                    } elseif ($remainingDaysRounded >= 365) {
                        $remainingDaysFinal = abs(round($remainingDays / 365)) . ' year/s';
                        $agreement->status = "<span style='color: green;'>Active ({$remainingDaysFinal} remaining)</span>";
                    } elseif ($remainingDaysRounded < 365) {
                        $remainingDaysFinal = abs(round($remainingDays / 30)) . ' months';
                        $agreement->status = "<span style='color: green;'>Active ({$remainingDaysFinal} remaining)</span>";
                    }
                }

                // Include service report info in the agreement object
                $agreement->service_reports = $agreement->serviceReports->pluck('sr_number')->toArray(); // Adjust to fetch the desired fields

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

            // Append the current start and end dates to the date_history if they exist
            if (!empty($agreement->start_date) && !empty($agreement->end_date)) {
                $dateHistory[] = [
                    'start_date' => $agreement->start_date,
                    'end_date' => $agreement->end_date,
                ];
            }

            // Update the maintenance agreement with new dates and the updated date history
            $agreement->update([
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'date_history' => json_encode($dateHistory), // Store updated date history as a JSON string
            ]);

            return redirect('/ma-reports')->with('message', 'MA renewed successfully');
        } catch (\Throwable $th) {
            // Log the error message for debugging
            Log::error('Error renewing Maintenance Agreement: ' . $th->getMessage());
            return redirect('/create/ma-report')->with('message', 'MA renewal failed');
        }
    }
    // update account manager
    public function updateAccountManager(Request $request, $id)
    {
        // dd($request->all());
        try {
            // Find the existing maintenance agreement
            $agreement = MaintenanceAgreement::findOrFail($id);

            // Validate the request data
            $validated = $request->validate([
                'account_manager' => 'required',
                // 'account_manager_id' => 'nullable',
            ]);

            // Get the old account manager if it's not "N/A" or null
            $oldAccountManager = $agreement->account_manager;
            if ($oldAccountManager && $oldAccountManager !== 'N/A') {
                $accountManagerHistory = $agreement->account_manager_history ?? [];
                $accountManagerHistory[] = [
                    'manager' => $oldAccountManager,
                    'timestamp' => now(), // optional timestamp
                ];
                $agreement->account_manager_history = json_encode($accountManagerHistory);
            }

            // Update the maintenance agreement with new account manager details
            $agreement->update([
                'account_manager' => $validated['account_manager'],
                // 'account_manager_id' => $validated['account_manager_id'],
                'account_manager_history' => $agreement->account_manager_history
            ]);

            return redirect('/ma-reports')->with('message', 'Account Manager updated successfully');
        } catch (\Throwable $th) {
            // Log the error message for debugging
            Log::error('Error updating Account Manager: ' . $th->getMessage());
            return redirect('/ma-reports')->with('message', 'Account Manager update failed');
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
                // Safely handle date_history
                $dateHistory = '';
                if (!empty($agreement->date_history)) {
                    $decodedHistory = json_decode($agreement->date_history, true);

                    // Ensure it's an array before mapping
                    if (is_array($decodedHistory)) {
                        $dateHistory = implode(', ', array_map(function ($date) {
                            return (isset($date['start_date']) ? $date['start_date'] : 'N/A') . ' - ' .
                                (isset($date['end_date']) ? $date['end_date'] : 'N/A');
                        }, $decodedHistory));
                    }
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
