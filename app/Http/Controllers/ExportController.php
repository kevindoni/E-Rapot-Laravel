<?php

namespace App\Http\Controllers;

use App\Exports\NilaiExport;
use Illuminate\Http\Request;
use App\Exports\EkstraExport;
use App\Exports\MagangExport;
use App\Exports\CatatanExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function nilai($id)
    {
        return Excel::download(new NilaiExport($id), 'nilai.xlsx');
    }

    public function ekstra($id)
    {
        return Excel::download(new EkstraExport($id), 'ekstra.xlsx');
    }

    public function catatan()
    {
        return Excel::download(new CatatanExport, 'catatan.xlsx');
    }

    public function magang()
    {
        return Excel::download(new MagangExport, 'magang.xlsx');
    }
}
