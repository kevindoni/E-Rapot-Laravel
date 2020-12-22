<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Prodi;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Ekstra;
use App\Models\KelasSiswa;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->level == "Admin") {
            $tahun = Tahun::where('status', 'Aktif')->first();
            $ekstra = Ekstra::count();
            $guru = Guru::count();
            $prodi = Prodi::count();
            $kelas = Kelas::count();
            $mapel = Mapel::count();
            $siswa = Siswa::count();
            $user = User::count();
            return view('home', compact('tahun', 'ekstra', 'guru', 'prodi', 'kelas', 'mapel', 'siswa', 'user'));
        } elseif (Auth::user()->level == "Guru") {
            return redirect()->route('nilai-mapel.index');
        } elseif (Auth::user()->level == "Siswa") {
            return redirect()->route('rapot');
        } elseif (Auth::user()->level == "Wali Kelas") {
            $tahun = Tahun::where('status', 'Aktif')->first();
            $siswa = KelasSiswa::where('kelas_id', Auth::user()->data_id)->count();
            return view('home', compact('tahun', 'siswa'));
        } else {
            return redirect()->back();
        }
    }

    public function setting()
    {
        $profile = Profile::find(1);
        return view('admin.profile', compact('profile'));
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama_sekolah' => 'required',
            'alamat_sekolah' => 'required'
        ]);

        $profile = Profile::find(1);

        if ($request->hasFile('logo_sekolah')) {
            if ($profile->logo_sekolah != null) {
                Storage::delete('public/' . $profile->logo_sekolah);
            }
            $photo = $request->file('logo_sekolah');
            $image_name = "favicon." . $photo->extension();
            $photo->storeAs('/images', $image_name, 'public');
            $data = [
                'nama_sekolah' => $request->nama_sekolah,
                'alamat_sekolah' => $request->alamat_sekolah,
                'logo_sekolah' => 'images/' . $image_name
            ];
        } else {
            $data = [
                'nama_sekolah' => $request->nama_sekolah,
                'alamat_sekolah' => $request->alamat_sekolah
            ];
        }

        $profile->update($data);

        return redirect()->back()->with('success', 'Setting profile sekolah berhasil disimpan!');
    }
}
