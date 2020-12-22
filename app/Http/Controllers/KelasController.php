<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Jadwal;
use App\Models\KelasMapel;
use App\Models\KelasSiswa;
use App\Models\NilaiMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noKelas = [
            [
                "id" => "X",
                "name" => "X (Sepuluh)"
            ],
            [
                "id" => "XI",
                "name" => "XI (Sebelas)"
            ],
            [
                "id" => "XII",
                "name" => "XII (Dua Belas)"
            ]
        ];
        $prodi = Prodi::orderBy('nama_prodi')->get();
        return view('admin.kelas.index', compact('noKelas', 'prodi'));
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
            'kelas' => 'required',
            'prodi_id' => 'required'
        ]);

        $prodi = Prodi::find($request->prodi_id);

        $jumKelas = Kelas::where('kelas', $request->kelas)->where('prodi_id', $prodi->id)->count();
        if ($jumKelas > 26) {
            return redirect()->back()->with('error', 'Data kelas ini sudah melebihi kapasitas!');
        } else {
            $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            for ($i=0; $i < 26; $i++) {
                $cekKelas = Kelas::where('kelas', $request->kelas)->where('prodi_id', $prodi->id)->where('nama', $string[$i])->first();
                if ($cekKelas == false || $cekKelas->id == $request->kelas_id) {
                    $nama = $string[$i];
                    break;
                }
            }
        }

        if ($request->kelas_id) {
            $kelas = Kelas::find($request->kelas_id);
            if ($kelas->status == "Aktif") {
                $name = "Wali Kelas " . $request->kelas . " " . $prodi->singkatan . " " . $nama;
                $username = strtolower($request->kelas . $prodi->singkatan . $nama);
                $user = User::where('level', 'Wali Kelas')->where('data_id', $kelas->id)->first();
                $user->update([
                    'name' => $name,
                    'username' => $username,
                    'password' => Hash::make("wali@" . $username),
                    'level' => 'Wali Kelas',
                    'data_id' => $kelas->id
                ]);
            }
        }

        Kelas::updateOrCreate(
            [
                'id' => $request->kelas_id
            ],
            [
                'kelas' => $request->kelas,
                'prodi_id' => $prodi->id,
                'nama' => $nama,
                'nama_kelas' => $request->kelas . " " . $prodi->singkatan . " " . $nama,
                'wali_kelas' => $request->wali_kelas
            ]
        );

        if ($request->kelas_id) {
            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui!');
        } else {
            return redirect()->back()->with('success', 'Data kelas berhasil ditambahkan!');
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
        $kelas = Kelas::find($id);
        $noKelas = [
            [
                "id" => "X",
                "name" => "X (Sepuluh)"
            ],
            [
                "id" => "XI",
                "name" => "XI (Sebelas)"
            ],
            [
                "id" => "XII",
                "name" => "XII (Dua Belas)"
            ]
        ];
        $prodi = Prodi::orderBy('nama_prodi')->get();
        $guru = Guru::orderBy('nama_guru')->get();
        return view('admin.kelas.edit', compact('kelas', 'noKelas', 'prodi', 'guru'));
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
        NilaiMapel::where('kelas_id', $id)->delete();
        User::where('level', 'Wali Kelas')->where('data_id', $id)->delete();
        Jadwal::where('kelas_id', $id)->delete();
        KelasMapel::where('kelas_id', $id)->delete();
        KelasSiswa::where('kelas_id', $id)->delete();
        Kelas::find($id)->delete();
        return redirect()->back()->with('success', 'Data kelas berhasil dihapus!');
    }
}
