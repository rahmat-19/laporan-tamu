<?php

namespace App\Http\Livewire;

use App\Models\UserTamu;
use Livewire\Component;

class SearchTamuLogin extends Component
{
    public $search;
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];
    public function keperlaun($value)
    {
        $this->emit('keperlaun', $value);
        $this->dispatchBrowserEvent('openmodal');
    }
    public function render()
    {
        $filter =  UserTamu::where('email', 'like', '%' . $this->search . '%');
        $datas = $filter->orderby('status', 'ASC')->orderby('name', 'ASC')->get();
        return view('livewire.search-tamu-login',  [
            'datas' => $datas
        ]);
    }
}
