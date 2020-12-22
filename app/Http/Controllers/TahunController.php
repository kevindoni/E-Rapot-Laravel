<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semester = ['Ganjil', 'Genap'];
        for ($i = 2020; $i < date('Y')+3; $i++) { 
            $year[] = $i;
        }
        rsort($year);
        return view('admin.tahun.index', compact('semester', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'semester' => 'required',
            'tahun' => 'required',
            'kpl_sklh' => 'required',
            'nip_kespek' => 'required'
        ]);

        if ($request->tahun_id) {
            $cekData = Tahun::find($request->tahun_id);
            if ($cekData->tahun == $request->tahun) {
                if ($cekData->semester != $request->semester) {
                    $cekSemester = Tahun::where('tahun', $request->tahun)->where('semester', $request->semester)->count();
                    if ($cekSemester > 0) {
                        return redirect()->back()->with('error', 'Data Tahun ' . $request->tahun . ' Semester ' . $request->semester . ' Sudah Terdaftar!');
                    }
                }
            } else {
                $cekTahun = Tahun::where('tahun', $request->tahun)->count();
                if ($cekTahun > 0) {
                    $cekSemester = Tahun::where('tahun', $request->tahun)->where('semester', $request->semester)->count();
                    if ($cekSemester > 0) {
                        return redirect()->back()->with('error', 'Data Tahun ' . $request->tahun . ' Semester ' . $request->semester . ' Sudah Terdaftar!');
                    }
                }
            }
        } else {
            $cekTahun = Tahun::where('tahun', $request->tahun)->count();
            if ($cekTahun > 0) {
                $cekSemester = Tahun::where('tahun', $request->tahun)->where('semester', $request->semester)->count();
                if ($cekSemester > 0) {
                    return redirect()->back()->with('error', 'Data Tahun ' . $request->tahun . ' Semester ' . $request->semester . ' Sudah Terdaftar!');
                }
            }
        }

        Tahun::updateOrCreate(
            [
                'id' => $request->tahun_id
            ],
            [
                'semester' => $request->semester,
                'tahun' => $request->tahun,
                'kpl_sklh' => $request->kpl_sklh,
                'nip_kespek' => $request->nip_kespek,
                'status' => "Tidak Aktif"
            ]
        );

        if ($request->tahun_id) {
            return redirect()->route('tahun.index')->with('success', 'Data tahun berhasil diperbarui!');
        } else {
            return redirect()->back()->with('success', 'Data tahun berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tahunAll = Tahun::all();
        for ($i = 0; $i < count($tahunAll); $i++) {
            Tahun::find($tahunAll[$i]->id)->update(['status' => 'Tidak Aktif']);
        }
        Tahun::find($id)->update(['status' => 'Aktif']);
        $tahun = Tahun::find($id);

        return redirect()->back()->with('success', 'Semester ' . $tahun->semester . ' Tahun ' . $tahun->tahun . ' Aktif!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun = Tahun::findorfail($id);
        $semester = ['Ganjil', 'Genap'];
        for ($i = 2020; $i < date('Y')+3; $i++) { 
            $year[] = $i;
        }
        rsort($year);
        return view('admin.tahun.edit', compact('tahun', 'semester', 'year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
