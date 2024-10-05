<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitReport;

class DebitReportController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            "status"=>200,
            "message"=> "Data Retieved",
            "data"=> DebitReport::with('dam.pobs','pob')->get()
        ]);
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
            "status"=>201,
            "message"=>"report Successfully Created!",
            "data"=>$save
        ]);
    }

    public function show(DebitReport $report)
    {
        return response()->json([
            "status" => 200,
            "message" => "Data Retrieved SuccessFully",
            "data" => $report
        ]);
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
            "status"=>200,
            "message"=>"Report Successfully updated!",
            "data"=>$update 
        ]);
    }

    public function destroy(DebitReport $report)
    {
        $report->delete();
        return response()->json([
            "status"=>204,
            "message"=>"Report Successfully deleted!" 
        ]);
    }
}
