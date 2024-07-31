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
        return view('maintenance_agreement.index', ['maintenace_agreements' => $data]) -> with('title', 'MA List');
    }

    public function show($id)
    {
        $data = MaintenanceAgreement::find($id);
       return view('maintenance_agreement.edit', ['maintenance_agreement' => $data]);
    }

    public function create()
    {   
        $users = User::all();
        return view('maintenance_agreement.create' , ['users' => $users]) -> with('title', 'Create MA');
    }

    public function store(Request $request){

        $validated = $request->validate([
            
        ]);

        $ma = MaintenanceAgreement::create($validated);
        return redirect('/ma-reports') -> with('message', 'MA created successfully');
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                
            ]);






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

    


}
