<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Tahun;
use App\Models\Jadwal;
use App\Models\KelasSiswa;
use App\Models\NilaiMapel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class NilaiMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = Jadwal::with('kelas', 'mapel')->where('guru_id', Auth::user()->data_id)->get();
        if ($jadwal->count() > 0) {
            $cekKelas = $jadwal->groupBy('kelas_id');
            foreach ($cekKelas as $data) {
                $kelas[] = array(
                    'id' => $data[0]->kelas_id,
                    'nama_kelas' => $data[0]->kelas->nama_kelas,
                );
            }
            return view('guru.index', compact('kelas'));
        }
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
            'nilai_p' => 'required',
            'nilai_k' => 'required'
        ]);

        $kelas = Kelas::find($request->kelas_id);

        if ($kelas->wali_kelas) {
            $siswa = Siswa::find($request->siswa_id);
            $mapel = Mapel::find($request->mapel_id);

            $data = NilaiMapel::updateOrCreate(
                [
                    'id' => $request->nilai_mapel_id
                ],
                [
                    'siswa_id' => $request->siswa_id,
                    'kelas_id' => $request->kelas_id,
                    'wali_kelas' => $kelas->wali_kelas,
                    'mapel_id' => $request->mapel_id,
                    'nilai_p' => $request->nilai_p,
                    'nilai_k' => $request->nilai_k,
                    'tahun_id' => $request->tahun_id,
                    'kelompok' => $mapel->kelompok
                ]
            );

            return response()->json(['success' => 'Nilai mapel ' . $siswa->nama_siswa . ' berhasil disimpan!', 'data' => $data]);
        } else {
            return response()->json(['error' => 'Wali kelas ini tidak ada!']);
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
        $id = Crypt::decrypt($id);
        $jadwal = Jadwal::with('mapel')->find($id);
        $siswa = KelasSiswa::with('siswa')->where('kelas_id', $jadwal->kelas_id)->get();
        $tahun = Tahun::where('status', 'Aktif')->first();
        $kelas = Kelas::with('wali')->find($jadwal->kelas_id);
        return view('guru.show', compact('jadwal', 'siswa', 'tahun', 'kelas'));
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
        $cekJadwal = Jadwal::where('kelas_id', $request->kelas_id)->where('guru_id', $id)->where('mapel_id', $request->mapel_id)->get();
        if ($cekJadwal->count() > 0) {
            $jadwal = Jadwal::where('kelas_id', $request->kelas_id)->where('guru_id', $id)->where('mapel_id', $request->mapel_id)->first();
            return redirect()->route('nilai-mapel.show', Crypt::encrypt($jadwal->id));
        } else {
            return redirect()->back()->with('error', 'Maaf data jadwal ini tidak ada!');
        }
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
