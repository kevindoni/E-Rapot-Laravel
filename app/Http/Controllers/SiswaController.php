<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\KelasSiswa;
use App\Models\Magang;
use App\Models\NilaiEkstra;
use App\Models\NilaiMapel;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jk = ['Laki - Laki', 'Perempuan'];
        $agama = ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'];
        $keluarga = ['Anak Kandung', 'Anak Tiri'];
        return view('admin.siswa.index', compact('jk', 'agama', 'keluarga'));
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
            'nama_siswa' => 'required',
            'no_induk' => 'required',
            'nisn' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'status_keluarga' => 'required',
            'anak_ke' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'asal_sekolah' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_ortu' => 'required',
            'telp_ortu' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
        ]);

        if ($request->siswa_id) {
            $siswa = Siswa::find($request->siswa_id);
            if ($siswa->status == "Aktif") {
                $user = User::where('level', 'Siswa')->where('data_id', $siswa->id)->first();
                $user->update([
                    'name' => $siswa->nama_siswa,
                    'username' => $siswa->no_induk,
                    'password' => Hash::make("siswa@123"),
                    'level' => 'Siswa',
                    'data_id' => $siswa->id
                ]);
            }
        }

        $siswa = Siswa::updateOrCreate(
            [
                'id' => $request->siswa_id
            ],
            [
                'nama_siswa' => $request->nama_siswa,
                'no_induk' => $request->no_induk,
                'nisn' => $request->nisn,
                'jk' => $request->jk,
                'agama' => $request->agama,
                'status_keluarga' => $request->status_keluarga,
                'anak_ke' => $request->anak_ke,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'asal_sekolah' => $request->asal_sekolah,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'alamat_ortu' => $request->alamat_ortu,
                'telp_ortu' => $request->telp_ortu,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'nama_wali' => $request->nama_wali,
                'alamat_wali' => $request->alamat_wali,
                'telp_wali' => $request->telp_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
            ]
        );

        if ($request->siswa_id) {
            if ($siswa->lulus == 'Belum Lulus') {
                return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
            } else {
                return redirect()->route('lulus.index')->with('success', 'Data siswa berhasil diperbarui!');
            }
        } else {
            return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan!');
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
        $jk = ['Laki - Laki', 'Perempuan'];
        $agama = ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'];
        $keluarga = ['Anak Kandung', 'Anak Tiri'];
        $siswa = Siswa::find($id);
        return view('admin.siswa.edit', compact('jk', 'agama', 'keluarga', 'siswa'));
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
        NilaiMapel::where('siswa_id', $id)->delete();
        Catatan::where('siswa_id', $id)->delete();
        Magang::where('siswa_id', $id)->delete();
        NilaiEkstra::where('siswa_id', $id)->delete();
        KelasSiswa::where('siswa_id', $id)->delete();
        User::where('level', 'Siswa')->where('data_id', $id)->delete();
        Siswa::find($id)->delete();
        return redirect()->back()->with('success', 'Data siswa berhasil dihapus!');
    }
}
