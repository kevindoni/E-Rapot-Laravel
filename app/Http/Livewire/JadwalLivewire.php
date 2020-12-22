<?php

namespace App\Http\Livewire;

use App\Models\Jadwal;
use Livewire\Component;
use Livewire\WithPagination;

class JadwalLivewire extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.jadwal-livewire', [
            'jadwal' => Jadwal::select('jadwal.id', 'kelas.nama_kelas', 'guru.nama_guru', 'mapel.nama_mapel')
                ->join('kelas', 'jadwal.kelas_id', 'kelas.id')
                ->join('guru', 'jadwal.guru_id', 'guru.id')
                ->join('mapel', 'jadwal.mapel_id', 'mapel.id')
                ->where('nama_kelas', 'like', '%' . $this->search . '%')
                ->where('nama_guru', 'like', '%' . $this->search . '%')
                ->orWhere('nama_mapel', 'like', '%' . $this->search . '%')
                ->orderBy('nama_kelas')
                ->orderBy('nama_mapel')
                ->paginate($this->paginate)
        ]);
    }
}
