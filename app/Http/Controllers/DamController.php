<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dam;

class DamController extends Controller
{
    //
    public function index(Request $request)
    {
        $data =  Dam::with('latest_debit_report')->paginate($request->query('pageSize'));
        return response()->json($data,200);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'river_name' => 'required',
            'dam_name' => 'required',
            'long' => 'required',
            'lat' => 'required',
            'siap' => 'required',
            'siaga' => 'required',
            'awas' => 'required',
        ]);
        $save =Dam::create([
            "river_name"=>$request->river_name,
            "dam_name"=>$request->dam_name,
            "long"=>$request->long,
            "lat"=>$request->lat,
            "siap"=>$request->siap,
            "siaga"=>$request->siaga,
            "awas"=>$request->awas,
        ]);
        return response()->json([
            "status"=>"OKE",
            "message"=>"Dam Successfully Created!",
            "data"=>$save
        ],201);
    }

    public function show(Dam $dam)
    {
        $dam->load('latest_debit_report.pob');
        // if($dam->latest_debit_report){
        //     $dam->latest_debit_report->status = $dam->status;
        // }
        // Return response with the dam data and status
        return response()->json([
            "status" => "OKE",
            "message" => "Data Retrieved SuccessFully",
            "data" => $dam
        ],200);
    }

    public function update(Request $request, Dam $dam)
    {
        $validate = $request->validate([
            'river_name' => 'required',
            'dam_name' => 'required',
            'long' => 'required',
            'lat' => 'required',
            'siap' => 'required',
            'siaga' => 'required',
            'awas' => 'required',
        ]);

        $update = $dam->update($request->all());
        return response()->json([
            "status"=>"OKE",
            "message"=>"Dam Successfully updated!",
            "data"=>$update 
        ],200);
    }

    public function destroy(Dam $dam)
    {
        $dam->delete();
        return response()->json([
            "status"=>"OKE",
            "message"=>"Dam Successfully deleted!" 
        ],204);
    }
}
