<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Jadwal;
use App\Models\KelasMapel;
use App\Models\KelasSiswa;
use App\Models\NilaiMapel;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.prodi.index');
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
            'nama_prodi' => 'required',
            'singkatan' => 'required',
            'bidang' => 'required',
            'program' => 'required',
            'kompetensi' => 'required'
        ]);

        Prodi::updateOrCreate(
            [
                'id' => $request->prodi_id
            ],
            [
                'nama_prodi' => $request->nama_prodi,
                'singkatan' => strtoupper($request->singkatan),
                'bidang' => $request->bidang,
                'program' => $request->program,
                'kompetensi' => $request->kompetensi
            ]
        );

        if ($request->prodi_id) {
            return redirect()->route('prodi.index')->with('success', 'Data jurusan berhasil diperbarui!');
        } else {
            return redirect()->back()->with('success', 'Data jurusan berhasil ditambahkan!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prodi = Prodi::find($id);
        return view('admin.prodi.edit', compact('prodi'));
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
        $kelas = Kelas::where('prodi_id', $id)->get();
        foreach ($kelas as $data) {
            NilaiMapel::where('kelas_id', $data->id)->delete();
            Jadwal::where('kelas_id', $id)->delete();
            KelasMapel::where('kelas_id', $id)->delete();
            KelasSiswa::where('kelas_id', $id)->delete();
            Kelas::find($data->id)->delete();
        }
        Prodi::find($id)->delete();
        return redirect()->back()->with('success', 'Data jurusan berhasil dihapus!');
    }
}
