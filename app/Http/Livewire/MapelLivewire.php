<?php

namespace App\Http\Livewire;

use App\Models\Mapel;
use Livewire\Component;
use Livewire\WithPagination;

class MapelLivewire extends Component
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
        return view('livewire.mapel-livewire', [
            'mapel' => Mapel::where('nama_mapel', 'like', '%' . $this->search . '%')->orWhere('kelompok', 'like', '%' . $this->search . '%')->orderBy('kelompok')->orderBy('nama_mapel')->paginate($this->paginate)
        ]);
    }
}
