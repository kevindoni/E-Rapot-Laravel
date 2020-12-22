<?php

namespace App\Http\Livewire;

use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSiswa extends Component
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
        return view('livewire.admin-siswa', [
            'siswa' => Siswa::where('nama_siswa', 'like', '%' . $this->search . '%')->orderBy('nama_siswa')->paginate($this->paginate)
        ]);
    }
}
