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
        $request->validate([
            'name' => 'required',
        ]);

        return Dam::create($request->all());
    }

    public function show(Dam $dam)
    {
        return $dam;
    }

    public function update(Request $request, Dam $dam)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $dam->update($request->all());
        return $dam;
    }

    public function destroy(Dam $dam)
    {
        $dam->delete();
        return response(null, 204);
    }
}
