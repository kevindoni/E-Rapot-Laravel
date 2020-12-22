<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\KelasMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $guru = Guru::orderBy('nama_guru')->get();
        return view('admin.jadwal.index', compact('kelas', 'guru'));
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
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required'
        ]);

        Jadwal::updateOrCreate(
            [
                'id' => $request->jadwal_id
            ],
            [
                'kelas_id' => $request->kelas_id,
                'guru_id' => $request->guru_id,
                'mapel_id' => $request->mapel_id,
            ]
        );

        if ($request->jadwal_id) {
            return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui!');
        } else {
            return redirect()->back()->with('success', 'Data jadwal berhasil ditambahkan!');
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
        $jadwal = Jadwal::find($id);
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $guru = Guru::orderBy('nama_guru')->get();
        $mapel = KelasMapel::with('mapel')->where('kelas_id', $jadwal->kelas_id)->get();
        return view('admin.jadwal.edit', compact('jadwal', 'kelas', 'guru', 'mapel'));
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
        Jadwal::find($id)->delete();
        return redirect()->back()->with('success', 'Data jadwal berhasil dihapus!');
    }

    public function mapel(Request $request)
    {
        $cekMapel = KelasMapel::with('mapel')->where('kelas_id', $request->kelas)->get();
        foreach ($cekMapel as $data) {
            $newForm[] = array(
                'nama_mapel' => $data->mapel->nama_mapel,
                'id' => $data->mapel->id
            );
        }
        sort($newForm);
        return response()->json($newForm);
    }

    public function jadwal(Request $request)
    {
        $cekJadwal = Jadwal::with('mapel')->where('kelas_id', $request->kelas)->where('guru_id', Auth::user()->data_id)->get();
        foreach ($cekJadwal as $data) {
            $newForm[] = array(
                'nama_mapel' => $data->mapel->nama_mapel,
                'id' => $data->mapel->id
            );
        }
        sort($newForm);
        return response()->json($newForm);
    }
}
