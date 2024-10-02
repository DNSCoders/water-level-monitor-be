<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\POB;

class POBController extends Controller
{
    //
    public function index()
    {
        return POB::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        return POB::create($request->all());
    }

    public function show(POB $pob)
    {
        return $pob;
    }

    public function update(Request $request, POB $pob)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $pob->update($request->all());
        return $pob;
    }

    public function destroy(POB $pob)
    {
        $pob->delete();
        return response(null, 204);
    }
}
