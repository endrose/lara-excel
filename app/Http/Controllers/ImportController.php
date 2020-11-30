<?php

namespace App\Http\Controllers;

use App\Models\File;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\FileExport;
use App\Imports\FileImport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Generator;

class ImportController extends Controller
{
    //
    public function index()
    {
        $excel = File::all();

        return view('excelExportImport', compact('excel'));
    }

public function viewQr()
    {
        $excel = File::all();
        $title = 'View QR Code';
        return view('view-qrcode', compact('excel','title'));
    }

    public function export_pdf()
    {
        $excel = File::all();
        $pdf = PDF::loadView('excelExportImport',compact('excel'));
        return $pdf->save(public_path('/pdf_file/'). 'file.pdf');

    }

    public function export()
    {
        return Excel::download(new FileExport, 'data.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'nama_file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // RETRIVE FILE XLS
        $file = $request->file('nama_file');

        // RANDOM NAME FILE
        $nama_file = Str::random(40) . $file->getClientOriginalName();

        // UPLOAD FILE TO STORAGE
        $file->move('code_file', $nama_file);

        // IMPORT DATA
        $import =  Excel::import(new FileImport, public_path('/code_file/' . $nama_file));

        if ($import) {
            // REDIRECT
            return redirect()->route('import.index')->with('success', 'Files imported!');
        } else {
            return redirect()->route('import.index')->with('danger', 'Files cant imported!');
        }
    }

public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        File::whereIn('id', $ids)->delete();
        return response()->json(["success"=>"Files has beend deleted!"]);
    }
}
