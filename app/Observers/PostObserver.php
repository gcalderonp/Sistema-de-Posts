<?php
//se registra el observador en eventservicesproviders
namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{

    public function creating(Post $post)
    {
        // para que no me de error al ejecutar los seeder, condiciono que no ejecute esta linea si se esta insertando registros desde la consola, esto devuelve true si lo ingreso por la consola, es por ello la negacion
        if(! \App::runningInConsole()){
            $post->user_id = auth()->user()->id;
        }
    }

    // este metodo se ejejuta despues que se haya eliminado
    // public function deleted(Post $post)
    // {

    // }

    // este metodo se ejecuta antes que se elimine
    public function deleting(Post $post)
    {
        // pregunta si hay una imagen relacionada a este post
        if($post->image){
            Storage::delete($post->image->url);
        }
    }

}
