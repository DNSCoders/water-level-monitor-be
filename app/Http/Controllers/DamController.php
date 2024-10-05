<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dam;

class DamController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            "status"=>200,
            "message"=> "Data Retieved",
            "data"=> Dam::all()
        ]);
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
            "status"=>201,
            "message"=>"Dam Successfully Created!",
            "data"=>$save
        ]);
    }

    public function show(Dam $dam)
    {
        $dam->load('latest_debit_report');
        $dam->latest_debit_report->status = $dam->status;
        // Return response with the dam data and status
        return response()->json([
            "status" => 200,
            "message" => "Data Retrieved SuccessFully",
            "data" => $dam
        ]);
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
            "status"=>200,
            "message"=>"Dam Successfully updated!",
            "data"=>$update 
        ]);
    }

    public function destroy(Dam $dam)
    {
        $dam->delete();
        return response()->json([
            "status"=>204,
            "message"=>"Dam Successfully deleted!" 
        ]);
    }
}
