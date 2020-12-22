<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class SiswaLivewire extends Component
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
        return view('livewire.siswa-livewire', [
            'siswa' => Siswa::where('nama_siswa', 'like', '%' . $this->search . '%')->where('lulus', 'Belum Lulus')->orderBy('nama_siswa')->paginate($this->paginate)
        ]);
    }

    public function aktifkan($id)
    {
        $siswa = Siswa::find($id);
        User::create([
            'name' => $siswa->nama_siswa,
            'username' => $siswa->no_induk,
            'password' => Hash::make("siswa@123"),
            'level' => 'Siswa',
            'data_id' => $siswa->id
        ]);
        $siswa->update(['status' => 'Aktif']);

        $this->dispatchBrowserEvent('success', ['message' => 'User ' . $siswa->nama_siswa . ' berhasil diaktifkan!']);
    }

    public function nonaktifkan($id)
    {
        $siswa = Siswa::find($id);
        User::where('level', 'Siswa')->where('data_id', $id)->delete();
        $siswa->update(['status' => 'Belum Aktif']);

        $this->dispatchBrowserEvent('success', ['message' => 'User ' . $siswa->nama_siswa . ' berhasil dinonaktifkan!']);
    }
}
