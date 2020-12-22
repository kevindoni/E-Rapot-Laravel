<?php

namespace App\Http\Livewire;

use App\Models\Ekstra;
use Livewire\Component;
use Livewire\WithPagination;

class EkstraLivewire extends Component
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
        return view('livewire.ekstra-livewire', [
            'ekstra' => Ekstra::where('nama_ekstra', 'like', '%' . $this->search . '%')->orderBy('nama_ekstra')->paginate($this->paginate)
        ]);
    }
}
