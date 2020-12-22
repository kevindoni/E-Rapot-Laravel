<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\NilaiMapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.guru.index');
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
            'nip' => 'required',
            'nama_guru' => 'required'
        ]);

        if ($request->guru_id) {
            $guru = Guru::find($request->guru_id);
            if ($guru->status == "Aktif") {
                $user = User::where('level', 'Guru')->where('data_id', $guru->id)->first();
                $user->update([
                    'name' => $guru->nama_guru,
                    'username' => $guru->nip,
                    'password' => Hash::make("guru@123"),
                    'level' => 'Guru',
                    'data_id' => $guru->id
                ]);
            }
        }

        Guru::updateOrCreate(
            [
                'id' => $request->guru_id
            ],
            [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
            ]
        );

        if ($request->guru_id) {
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
        } else {
            return redirect()->back()->with('success', 'Data guru berhasil ditambahkan!');
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
        $guru = Guru::find($id);
        return view('admin.guru.edit', compact('guru'));
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
        NilaiMapel::where('wali_kelas', $id)->delete();
        $kelas = Kelas::where('wali_kelas', $id)->first();
        if ($kelas) {
            $kelas->update(['wali_kelas' => null]);
        }
        User::where('level', 'Guru')->where('data_id', $id)->delete();
        Jadwal::where('guru_id', $id)->delete();
        Guru::find($id)->delete();
        return redirect()->back()->with('success', 'Data guru berhasil dihapus!');
    }
}
