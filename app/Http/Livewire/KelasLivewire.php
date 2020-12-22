<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class KelasLivewire extends Component
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
        return view('livewire.kelas-livewire', [
            'kelas' => Kelas::with('prodi', 'wali')->where('nama_kelas', 'like', '%' . $this->search . '%')->orderBy('nama_kelas')->paginate($this->paginate)
        ]);
    }

    public function aktifkan($id)
    {
        $kelas = Kelas::with('prodi')->find($id);
        $name = "Wali Kelas " . $kelas->nama_kelas;
        $username = strtolower($kelas->kelas . $kelas->prodi->singkatan . $kelas->nama);
        User::create([
            'name' => $name,
            'username' => $username,
            'password' => Hash::make("wali@" . $username),
            'level' => 'Wali Kelas',
            'data_id' => $kelas->id
        ]);
        $kelas->update(['status' => 'Aktif']);

        $this->dispatchBrowserEvent('success', ['message' => 'User ' . $name . ' berhasil diaktifkan!']);
    }

    public function nonaktifkan($id)
    {
        $kelas = Kelas::with('prodi')->find($id);
        $name = "Wali Kelas " . $kelas->nama_kelas;
        User::where('level', 'Wali Kelas')->where('data_id', $id)->delete();
        $kelas->update(['status' => 'Belum Aktif']);

        $this->dispatchBrowserEvent('success', ['message' => 'User ' . $name . ' berhasil dinonaktifkan!']);
    }
}
