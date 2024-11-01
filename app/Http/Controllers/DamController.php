<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dam;
use Carbon\Carbon;

class DamController extends Controller
{
    //
    public function index(Request $request)
    {
        $data =  Dam::with('latest_debit_report')->paginate($request->query('pageSize'));

        $latestDate = collect($data->items())->map(function ($dam) {
            return $dam->latest_debit_report->created_at ?? null;
        })->filter()->max();
        
        $date = $latestDate ? Carbon::parse($latestDate)->format('d F Y H:i:s') : now()->format('d F Y H:i:s');

        $response = [
            'data' => $data->items(), // Use items() to get the paginated data array
            'counter_status' => [
                "awas" => $this->counter($data->items(),"Awas"),
                "siap" => $this->counter($data->items(),"Siap"),
                "siaga" => $this->counter($data->items(),"Siaga"),
                "aman" => $this->counter($data->items(),"Aman"),
                "unreported"=> $this->counter($data->items(), "unreported")
            ],
            'latest_report_date'=>$date,
            'pagination' => [
                'total' => $data->total(),
                'count' => $data->count(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage(),
            ]
        ];
    
        return response()->json($response, 200);
        // return response()->json($data,200);
    }

    protected function counter($data,$status){
        $counter = 0;
        foreach($data as $dt){
            if($status == "unreported"){
                if($dt->latest_debit_report == null){
                    $counter++;
                }
            }else{
                if($dt->latest_debit_report && $dt->latest_debit_report->status === $status){
                    $counter++;
                }
            }

        }
        return $counter;
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
            "rtsp_port"=>$request->rtsp_port,
            "state"=>$request->state
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
