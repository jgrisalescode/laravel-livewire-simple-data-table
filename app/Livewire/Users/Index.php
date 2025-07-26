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

    #[Url(history: true)]
    public $sortBy = 'created_at';

    public $sortDirection = 'DESC';

    public function updated($property)
    {
        if ($property === 'search'){
            $this->resetPage();
        }
    }

    public function setSortBy($sortByField)
    {
        if($sortByField === $this->sortBy){
            $this->sortDirection = ($this->sortDirection == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDirection = "DESC";
    }

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::search($this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
