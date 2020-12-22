<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\KelasMapel;
use App\Models\NilaiMapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelompok = ['Muatan Nasional', 'Muatan Kewilayahan', 'Dasar Bidang Keahlian', 'Dasar Program Keahlian', 'Kompetensi Keahlian'];
        return view('admin.mapel.index', compact('kelompok'));
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
            'nama_mapel' => 'required',
            'kelompok' => 'required',
            'kkm' => 'required',
            'bobot_p' => 'required',
            'bobot_k' => 'required'
        ]);

        Mapel::updateOrCreate(
            [
                'id' => $request->mapel_id
            ],
            [
                'nama_mapel' => $request->nama_mapel,
                'kelompok' => $request->kelompok,
                'kkm' => $request->kkm,
                'bobot_p' => $request->bobot_p,
                'bobot_k' => $request->bobot_k
            ]
        );

        if ($request->mapel_id) {
            return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil diperbarui!');
        } else {
            return redirect()->back()->with('success', 'Data mapel berhasil ditambahkan!');
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
        $mapel = Mapel::find($id);
        $kelompok = ['Muatan Nasional', 'Muatan Kewilayahan', 'Dasar Bidang Keahlian', 'Dasar Program Keahlian', 'Kompetensi Keahlian'];
        return view('admin.mapel.edit', compact('mapel', 'kelompok'));
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
        NilaiMapel::where('mapel_id', $id)->delete();
        Jadwal::where('mapel_id', $id)->delete();
        KelasMapel::where('mapel_id', $id)->delete();
        Mapel::find($id)->delete();
        return redirect()->back()->with('success', 'Data mapel berhasil dihapus!');
    }
}
