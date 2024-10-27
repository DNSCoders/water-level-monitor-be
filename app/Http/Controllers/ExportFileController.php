<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitReport;
use App\Models\Dam;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportFileController extends Controller
{
    //
    public function export_report(Request $request)
    {

        $dam_id =  $request->input('dam_id');
        $startDate = $request->input('start_date'); // e.g., '2024-01-01'
        $endDate = $request->input('end_date');
        // $user = auth()->user();
        // $user->load('pob');


        $data = DebitReport::with('dam.pobs','pob');
        

        // if($user->pob){
        //     $data->where('pob_id',$user->pob->id);
        // }
        
        if($dam_id){
            $data->where('dam_id',$dam_id);
        }
        
        if($startDate && $endDate){
            $data->whereBetween('created_at', [$startDate, $endDate])->get();

        }

        $data = $data->get();

        // dd($data);


        $pdf = Pdf::loadView('pdf.debit_report', compact('data'));

        return $pdf->download('reports.pdf');
    }

    public function export_dam()
    {
        
        $dams = Dam::all(); 
       
        $pdf = Pdf::loadView('pdf.dam_report', compact('dams'));

        return $pdf->download('dam_report.pdf');
    }

}