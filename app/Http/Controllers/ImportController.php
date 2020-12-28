<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Imports\NilaiImport;
use Illuminate\Http\Request;
use App\Imports\EkstraImport;
use App\Imports\MagangImport;
use App\Imports\CatatanImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function nilai(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $jadwal = Jadwal::with('kelas.wali')->find($request->jadwal_id);
        if ($jadwal->kelas && $jadwal->kelas->wali) {
            $file = $request->file('file');
            $nama_file = rand() . $file->getClientOriginalName();
            $file->move('import/nilai', $nama_file);
            Excel::import(new NilaiImport, public_path("/import/nilai/" . $nama_file));

            return redirect()->back()->with('success', 'Data nilai Berhasil Diimport!');
        } else {
            return redirect()->back()->with('error', 'Wali kelas ini tidak ada!');
        }
    }

    public function ekstra(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('import/ekstra', $nama_file);
        Excel::import(new EkstraImport, public_path("/import/ekstra/" . $nama_file));

        return redirect()->back()->with('success', 'Data ekstra Berhasil Diimport!');
    }

    public function catatan(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('import/catatan', $nama_file);
        Excel::import(new CatatanImport, public_path("/import/catatan/" . $nama_file));

        return redirect()->back()->with('success', 'Data catatan Berhasil Diimport!');
    }

    public function magang(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('import/magang', $nama_file);
        Excel::import(new MagangImport, public_path("/import/magang/" . $nama_file));

        return redirect()->back()->with('success', 'Data magang Berhasil Diimport!');
    }
}
