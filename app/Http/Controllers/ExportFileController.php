<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitReport;
use App\Models\Dam;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ExportFileController extends Controller
{
    //
    public function download_report(Request $request)
    {

        $dam_id =  $request->input('dam_id');
        $startDate = $request->input('start_date'); // e.g., '2024-01-01'
        $endDate = $request->input('end_date') ?? Carbon::now()->format('Y-m-d');

        $data = DebitReport::with('dam.pobs','pob');
        
        
        if($dam_id){
            $data->where('dam_id',$dam_id);
        }
        
        if($startDate && $endDate){
            $data->whereBetween('created_at', [$startDate, $endDate])->get();

        }

        $data = $data->get();

        $date = $data->max('created_at') ? Carbon::parse($data->max('created_at'))->format('d F Y') : now()->format('d F Y');

        if ($startDate) {
            $date = Carbon::parse($startDate)->format('d F Y') . ' - ' . $date;
        }

        if ($endDate) {
            $date = Carbon::parse($startDate)->format('d F Y') . ' - ' . Carbon::parse($endDate)->format('d F Y');
        }


        $pdf = Pdf::loadView('pdf.debit_report', compact('data','date'));

        return $pdf->download('reports.pdf');
    }

    public function download_dam()
    {
        
        $dams = Dam::with('latest_debit_report')->get();

        // Find the latest created_at date from the latest_debit_report relation
        $latestDate = $dams->map(function ($dam) {
            return $dam->latest_debit_report->created_at ?? null;
        })->filter()->max();
        
        $date = $latestDate ? Carbon::parse($latestDate)->format('d F Y') : now()->format('d F Y');
        
        $pdf = Pdf::loadView('pdf.dam_report', compact('dams', 'date'));

        return $pdf->download('dam_report.pdf');
    }

    public function preview_report(Request $request)
    {

        $dam_id =  $request->query('dam_id');
        $startDate = $request->query('start_date'); // e.g., '2024-01-01'
        $endDate = $request->query('end_date') ?? Carbon::now()->format('Y-m-d');

        $data = DebitReport::with('dam.pobs','pob');
        
        
        if($dam_id){
            $data->where('dam_id',$dam_id);
        }
        
        if($startDate && $endDate){
            $data->whereBetween('created_at', [$startDate, $endDate])->get();

        }

        $data = $data->get();

        $date = $data->max('created_at') ? Carbon::parse($data->max('created_at'))->format('d F Y') : now()->format('d F Y');

        if ($startDate) {
            $date = Carbon::parse($startDate)->format('d F Y') . ' - ' . $date;
        }

        if ($endDate) {
            $date = Carbon::parse($startDate)->format('d F Y') . ' - ' . Carbon::parse($endDate)->format('d F Y');
        }


        $pdf = Pdf::loadView('pdf.debit_report', compact('data','date'));
        return $pdf->stream('reports.pdf');
    }

    public function preview_dam()
    {
        
        $dams = Dam::with('latest_debit_report')->get();

        // Find the latest created_at date from the latest_debit_report relation
        $latestDate = $dams->map(function ($dam) {
            return $dam->latest_debit_report->created_at ?? null;
        })->filter()->max();
        
        $date = $latestDate ? Carbon::parse($latestDate)->format('d F Y') : now()->format('d F Y');
        
        $pdf = Pdf::loadView('pdf.dam_report', compact('dams', 'date'));
        
        return $pdf->stream('dam_report.pdf');
    }

}