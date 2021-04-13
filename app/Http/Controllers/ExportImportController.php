<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
use App\Exports\Export;

class ExportImportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImportExport()
    {
       return view('uploadcsv');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        Excel::import(new Import, $request->file('csv_file'));
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new Export, 'posts.xlsx');
    }    
}