<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::search($this->search)
                ->latest()
                ->paginate(10)
        ]);
    }
}
