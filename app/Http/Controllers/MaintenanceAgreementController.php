<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceAgreement;
use Illuminate\Http\Request;
use App\Models\User;


class MaintenanceAgreementController extends Controller
{
    
    public function index()
    {

        $data = MaintenanceAgreement::all();
        return view('maintenance_agreement.index', ['maintenance_agreements' => $data]) -> with('title', 'MA List');
    }

    public function show($id)
    {
        $data = MaintenanceAgreement::find($id);
       return view('maintenance_agreement.edit', ['maintenance_agreements' => $data]);
    }

    public function create()
    {   

        return view('maintenance_agreement.create') -> with('title', 'Create MA');
    }

    public function store(Request $request){

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


        MaintenanceAgreement::create($validated);
        return redirect('/ma-reports') -> with('message', 'MA created successfully');
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
            return redirect('/ma-reports') -> with('message', 'MA updated successfully');
        } catch (\Throwable $th) {
            return redirect('/ma-reports') -> with('message', 'MA update failed');
        }
        
    }

    public function destroy($id)
    {
        try {
            $data = MaintenanceAgreement::find($id);
            $data->delete();
            return redirect('/ma-reports') -> with('message', 'MA deleted successfully');
        } catch (\Throwable $th) {
            return redirect('/ma-reports') -> with('message', 'MA delete failed');
        }
    }

    public function getMaintenanceAgreements(Request $request)
    {
        $data = MaintenanceAgreement::all();
        return response()->json(['data' => $data]);
    }
}


