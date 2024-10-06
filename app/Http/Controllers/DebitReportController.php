<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitReport;

class DebitReportController extends Controller
{
    //
    public function index()
    {
        $data = DebitReport::with('dam.pobs','pob')->get();
        return response()->json([
            "status"=>"OKE",
            "message"=> "Data Retieved",
            "data"=> $data
        ],200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'dam_id' => 'required',
            'limpas' => 'required',
            'debit' => 'required',
            'cuaca' => 'required',
            'debit_ke_saluran_induk' => 'required',
            'pob_id' => 'required',
        ]);

        $save = DebitReport::create($request->all());
        return response()->json([
            "status"=>"OKE",
            "message"=>"report Successfully Created!",
            "data"=>$save
        ],201);
    }

    public function show(DebitReport $report)
    {
        return response()->json([
            "status" => "OKE",
            "message" => "Data Retrieved SuccessFully",
            "data" => $report
        ],200);
    }

    public function update(Request $request, DebitReport $report)
    {
        $request->validate([
            'dam_id' => 'required',
            'limpas' => 'required',
            'debit' => 'required',
            'cuaca' => 'required',
            'debit_ke_saluran_induk' => 'required',
            'pob_id' => 'required',
        ]);

        $update= $report->update($request->all());
        return response()->json([
            "status"=>"OKE",
            "message"=>"Report Successfully updated!",
            "data"=>$update 
        ],200);
    }

    public function destroy(DebitReport $report)
    {
        $report->delete();
        return response()->json([
            "status"=>"OKE",
            "message"=>"Report Successfully deleted!" 
        ],204);
    }
}
