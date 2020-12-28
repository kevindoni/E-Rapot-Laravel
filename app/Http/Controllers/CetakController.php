<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Magang;
use App\Models\Catatan;
use App\Models\NilaiMapel;
use App\Models\NilaiEkstra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CetakController extends Controller
{
    public function rapot($id)
    {
        $siswa = Siswa::find(Auth::user()->data_id);
        $tahun = Tahun::find($id);
        $kelas = NilaiMapel::with('kelas.prodi', 'wali')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->first();
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

        $pdf = PDF::loadView('rapot-pdf', ['siswa' => $siswa, 'kelas' => $kelas, 'tahun' => $tahun, 'mapel' => $mapel, 'catatan' => $catatan, 'magang' => $magang, 'ekstra' => $ekstra]);
        return $pdf->stream('rapot-pdf.pdf');
    }

    public function adminRapot($siswa_id, $tahun_id)
    {
        $siswa = Siswa::find($siswa_id);
        $tahun = Tahun::find($tahun_id);
        $kelas = NilaiMapel::with('kelas.prodi', 'wali')->where('siswa_id', $siswa->id)->where('tahun_id', $tahun->id)->first();
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

        $pdf = PDF::loadView('rapot-pdf', ['siswa' => $siswa, 'kelas' => $kelas, 'tahun' => $tahun, 'mapel' => $mapel, 'catatan' => $catatan, 'magang' => $magang, 'ekstra' => $ekstra]);
        return $pdf->stream('rapot-pdf.pdf');
    }
}
