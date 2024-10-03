<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dam;

class DamController extends Controller
{
    //
    public function index()
    {
        return Dam::all();
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
            "message"=>"Dam Successfully Created!" 
        ]);
    }

    public function show(Dam $dam)
    {
        return $dam;
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

        $dam->update($request->all());
        return response()->json([
            "status"=>"OKE",
            "message"=>"Dam Successfully updated!" 
        ]);
    }

    public function destroy(Dam $dam)
    {
        $dam->delete();
        return response()->json([
            "status"=>"OKE",
            "message"=>"Dam Successfully deleted!" 
        ]);
    }
}
