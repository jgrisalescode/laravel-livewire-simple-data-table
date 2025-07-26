<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search;

    #[Url(history: true)]
    public $perPage = 10;

    public function updated($property)
    {
        if ($property === 'search'){
            $this->resetPage();
        }
    }

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::search($this->search)
                ->latest()
                ->paginate($this->perPage)
        ]);
    }
}
