<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\User;
use Livewire\WithPagination;

class UsersIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    // formatear el paninado
    public function upatingSearch(){

        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
        ->orWhere('email', 'LIKE', '%'.$this->search.'%')
        ->paginate();
        return view('livewire.admin.users-index', compact('users'));
    }
}
