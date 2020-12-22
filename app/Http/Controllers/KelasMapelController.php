<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasMapel;
use App\Models\Mapel;
use Illuminate\Http\Request;

class KelasMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::with('mapel')->orderBy('nama_kelas')->get();
        return view('admin.kelas.mapel.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $mapel = Mapel::orderBy('nama_mapel')->get();
        return view('admin.kelas.mapel.create', compact('kelas', 'mapel'));
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
            'kelas' => 'required',
            'mapel' => 'required'
        ]);

        foreach ($request->mapel as $data) {
            $cekData = KelasMapel::where('kelas_id', $request->kelas)->where('mapel_id', $data)->count();
            if ($cekData == 0) {
                KelasMapel::Create([
                    'kelas_id' => $request->kelas,
                    'mapel_id' => $data
                ]);
            }
        }

        return redirect()->route('kelas-mapel.index')->with('success', 'Kelas mapel berhasil disimpan');
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
        KelasMapel::findorfail($id)->delete();
        return redirect()->back()->with('success', 'Kelas mapel berhasil dihapus!');
    }

    public function mapel(Request $request)
    {
        $mapel = Mapel::orderBy('nama_mapel')->get();
        foreach ($mapel as $data) {
            $cekKelas = KelasMapel::where('kelas_id', $request->kelas)->count();
            if ($cekKelas > 0) {
                $cekMapel = KelasMapel::with('mapel')->where('kelas_id', $request->kelas)->where('mapel_id', $data->id)->count();
                if ($cekMapel == 0) {
                    $newForm[] = array(
                        'nama_mapel' => $data->nama_mapel,
                        'id' => $data->id
                    );
                }
            } else {
                $newForm[] = array(
                    'nama_mapel' => $data->nama_mapel,
                    'id' => $data->id
                );
            }
        }
        return response()->json($newForm);
    }
}
