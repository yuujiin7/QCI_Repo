<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SR;

use Illuminate\Http\Request;

class SRController extends Controller
{
    public function index()
    {

        // $data = Tsg::all();
        // $data = Tsg::where('age','>','20') -> orderBy('first_name', 'asc') -> get();
        // dd($data);
        // $data = DB::table('tsgs') 
        //         -> select(DB::raw('count(*) as gender_count, gender'
        //         )) -> groupBy('gender') -> get();

        $data = SR::where('id', 10) -> firstOrFail() -> get();


        return view('sr.index', ['sr' => $data]);
    }

    public function show($id)
    {
        $data = SR::findOrFail($id);
        dd($data);
        return view('service_reports.show', ['sr' => $data]);
    }
}
