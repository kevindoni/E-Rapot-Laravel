<?php

namespace App\Http\Livewire;

use App\Models\Tahun;
use Livewire\Component;
use Livewire\WithPagination;

class TahunLivewire extends Component
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
        return view('livewire.tahun-livewire', [
            'tahun' => Tahun::where('semester', 'like', '%' . $this->search . '%')->orWhere('tahun', 'like', '%' . $this->search . '%')->orWhere('kpl_sklh', 'like', '%' . $this->search . '%')->orderBy('tahun', 'desc')->orderBy('semester')->paginate($this->paginate)
        ]);
    }
}
