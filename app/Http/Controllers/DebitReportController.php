<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitReport;

class DebitReportController extends Controller
{
    //
    public function index()
    {
        return DebitReport::with('dam.pobs','pob')->get();
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

        return DebitReport::create($request->all());
    }

    public function show(DebitReport $report)
    {
        return $report;
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

        $report->update($request->all());
        return $report;
    }

    public function destroy(DebitReport $report)
    {
        $report->delete();
        return response(null, 204);
    }
}
