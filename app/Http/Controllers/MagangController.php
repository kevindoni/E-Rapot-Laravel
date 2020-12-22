<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Magang;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::with('wali')->find(Auth::user()->data_id);
        $siswa = KelasSiswa::where('kelas_id', $kelas->id)->get();
        $tahun = Tahun::where('status', 'Aktif')->first();

        return view('wali.magang', compact('kelas', 'siswa', 'tahun'));
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
            'mitra' => 'required',
            'lokasi' => 'required',
            'lamanya' => 'required',
            'ket' => 'required'
        ]);

        $siswa = Siswa::find($request->siswa_id);

        $data = Magang::updateOrCreate(
            [
                'id' => $request->magang_id
            ],
            [
                'siswa_id' => $request->siswa_id,
                'mitra' => $request->mitra,
                'lokasi' => $request->lokasi,
                'lamanya' => $request->lamanya,
                'ket' => $request->ket,
                'tahun_id' => $request->tahun_id
            ]
        );

        return response()->json(['success' => 'Nilai PKL ' . $siswa->nama_siswa . ' berhasil disimpan!', 'data' => $data]);
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
        //
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
