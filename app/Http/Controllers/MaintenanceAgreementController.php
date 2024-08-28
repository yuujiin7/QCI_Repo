<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceAgreement;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use function Ramsey\Uuid\v1;

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
            $data->delete();
            return redirect('/ma-reports')->with('message', 'MA deleted successfully');
        } catch (\Throwable $th) {
            return redirect('/ma-reports')->with('message', 'MA delete failed');
        }
    }

    public function getMaintenanceAgreements(Request $request)
    {
        $data = MaintenanceAgreement::all();
        return response()->json(['data' => $data]);
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
}
