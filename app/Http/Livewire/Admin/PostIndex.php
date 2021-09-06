<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Post;
// este uso para la paginacion con livewire
use Livewire\WithPagination;

class PostIndex extends Component
{

    use WithPagination;
    // por defecto trata de usar tailwind para la paginacion, con esta linea le digo que use estilos de bootstrap ya que adminlte trabaja con bootstrap
    protected $paginationTheme = 'bootstrap';

    public $search;

    // este metodo se activa solo cuando el valor de la propiedad search cambie por ello el nombre de updating seguido del nombre de las propiedades a actualizar
    public function updatingSearch(){
        // reseteo la paginacion
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
        ->where('name', 'LIKE' , '%' . $this->search . '%')
        ->latest('id')
        ->paginate();
        return view('livewire.admin.post-index', compact('posts'));
    }
}
