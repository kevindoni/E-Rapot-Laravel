<?php

namespace App\Http\Livewire;

use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Magang;
use App\Models\Catatan;
use Livewire\Component;
use App\Models\NilaiMapel;
use App\Models\NilaiEkstra;
use Illuminate\Support\Facades\Auth;

class Rapot extends Component
{
    public $select = "";

    public function render()
    {
        $siswa = Siswa::find(Auth::user()->data_id);
        $listTahun = NilaiMapel::with('tahun')->where('siswa_id', $siswa->id)->get()->groupBy('tahun_id');
        $tahun = Tahun::find($this->select);
        if ($tahun) {
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
            return view('livewire.rapot', compact('listTahun', 'siswa', 'kelas', 'tahun', 'mapel', 'catatan', 'magang', 'ekstra'));
        } else {
            return view('livewire.rapot', compact('listTahun'));
        }
    }
}
