<?php

namespace App\Http\Livewire;

use App\Models\Prodi;
use Livewire\Component;
use Livewire\WithPagination;

class ProdiLivewire extends Component
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
        return view('livewire.prodi-livewire', [
            'prodi' => Prodi::where('nama_prodi', 'like', '%' . $this->search . '%')->orWhere('singkatan', 'like', '%' . $this->search . '%')->orderBy('nama_prodi')->paginate($this->paginate)
        ]);
    }
}
