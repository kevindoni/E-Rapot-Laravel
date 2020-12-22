<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\Magang;
use App\Models\NilaiEkstra;
use App\Models\NilaiMapel;
use App\Models\Siswa;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::find(Auth::user()->data_id);
        $tahun = Tahun::where('status', 'Aktif')->first();
        $kelas = NilaiMapel::with('kelas', 'wali')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->first();
        $MuatanNasional = NilaiMapel::with('mapel')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->where('kelompok', 'Muatan Nasional')->get();
        if ($MuatanNasional) {
            $mapel['Muatan Nasional'] = $MuatanNasional;
        } else {
            $mapel['Muatan Nasional'] = [];
        }
        $MuatanKewilayahan = NilaiMapel::with('mapel')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->where('kelompok', 'Muatan Kewilayahan')->get();
        if ($MuatanKewilayahan) {
            $mapel['Muatan Kewilayahan'] = $MuatanKewilayahan;
        } else {
            $mapel['Muatan Kewilayahan'] = [];
        }
        $DasarBidangKeahlian = NilaiMapel::with('mapel')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->where('kelompok', 'Dasar Bidang Keahlian')->get();
        if ($DasarBidangKeahlian) {
            $mapel['Dasar Bidang Keahlian'] = $DasarBidangKeahlian;
        } else {
            $mapel['Dasar Bidang Keahlian'] = [];
        }
        $DasarProgramKeahlian = NilaiMapel::with('mapel')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->where('kelompok', 'Dasar Program Keahlian')->get();
        if ($DasarProgramKeahlian) {
            $mapel['Dasar Program Keahlian'] = $DasarProgramKeahlian;
        } else {
            $mapel['Dasar Program Keahlian'] = [];
        }
        $KompetensiKeahlian = NilaiMapel::with('mapel')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->where('kelompok', 'Kompetensi Keahlian')->get();
        if ($KompetensiKeahlian) {
            $mapel['Kompetensi Keahlian'] = $KompetensiKeahlian;
        } else {
            $mapel['Kompetensi Keahlian'] = [];
        }
        $catatan = Catatan::where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->first();
        $magang = Magang::where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->get();
        $ekstra = NilaiEkstra::with('ekstra')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->get();
        return view('siswa.index', compact('siswa', 'kelas', 'tahun', 'mapel', 'catatan', 'magang', 'ekstra'));
    }
}
