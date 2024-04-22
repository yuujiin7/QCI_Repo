<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TsgController extends Controller
{
    public function index()
    {

        // $data = Tsg::all();
        // $data = Tsg::where('age','>','20') -> orderBy('first_name', 'asc') -> get();
        // dd($data);
        // $data = DB::table('tsgs') 
        //         -> select(DB::raw('count(*) as gender_count, gender'
        //         )) -> groupBy('gender') -> get();

        $data = Tsg::where('id', 10) -> firstOrFail() -> get();


        return view('tsg.index', ['tsg' => $data]);
    }

    public function show($id)
    {
        $data = Tsg::findOrFail($id);
        dd($data);
        return view('tsg.show', ['tsg' => $data]);
    }
}
