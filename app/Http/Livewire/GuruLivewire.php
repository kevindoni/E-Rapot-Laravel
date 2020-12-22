<?php

namespace App\Http\Livewire;

use App\Models\Guru;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class GuruLivewire extends Component
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
        return view('livewire.guru-livewire', [
            'guru' => Guru::where('nama_guru', 'like', '%' . $this->search . '%')->orWhere('nip', 'like', '%' . $this->search . '%')->orderBy('nama_guru')->paginate($this->paginate)
        ]);
    }

    public function aktifkan($id)
    {
        $guru = Guru::find($id);
        User::create([
            'name' => $guru->nama_guru,
            'username' => $guru->nip,
            'password' => Hash::make("guru@123"),
            'level' => 'Guru',
            'data_id' => $guru->id
        ]);
        $guru->update(['status' => 'Aktif']);

        $this->dispatchBrowserEvent('success', ['message' => 'User ' . $guru->nama_guru . ' berhasil diaktifkan!']);
    }

    public function nonaktifkan($id)
    {
        $guru = Guru::find($id);
        User::where('level', 'Guru')->where('data_id', $id)->delete();
        $guru->update(['status' => 'Belum Aktif']);

        $this->dispatchBrowserEvent('success', ['message' => 'User ' . $guru->nama_guru . ' berhasil dinonaktifkan!']);
    }
}
