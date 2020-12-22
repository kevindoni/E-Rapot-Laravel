<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Ekstra;
use App\Models\KelasSiswa;
use App\Models\NilaiEkstra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class NilaiEkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ekstra = Ekstra::orderBy('nama_ekstra')->get();
        return view('wali.ekstra.index', compact('ekstra'));
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
            'nilai' => 'required'
        ]);

        $siswa = Siswa::find($request->siswa_id);

        $data = NilaiEkstra::updateOrCreate(
            [
                'id' => $request->nilai_ekstra_id
            ],
            [
                'siswa_id' => $request->siswa_id,
                'ekstra_id' => $request->ekstra_id,
                'nilai' => $request->nilai,
                'tahun_id' => $request->tahun_id
            ]
        );

        return response()->json(['success' => 'Nilai mapel ' . $siswa->nama_siswa . ' berhasil disimpan!', 'data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $kelas = Kelas::with('wali')->find(Auth::user()->data_id);
        $siswa = KelasSiswa::where('kelas_id', $kelas->id)->get();
        $tahun = Tahun::where('status', 'Aktif')->first();
        $ekstra = Ekstra::find($id);

        return view('wali.ekstra.show', compact('kelas', 'siswa', 'tahun', 'ekstra'));
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
