<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitReport;

class DebitReportController extends Controller
{
    //
    public function index()
    {
        return DebitReport::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        return DebitReport::create($request->all());
    }

    public function show(DebitReport $report)
    {
        return $report;
    }

    public function update(Request $request, DebitReport $report)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $report->update($request->all());
        return $report;
    }

    public function destroy(DebitReport $report)
    {
        $report->delete();
        return response(null, 204);
    }
}
