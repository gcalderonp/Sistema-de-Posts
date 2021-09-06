<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // espera como minimo un parametro
    public function author(User $user, Post $post){
        // pregunta si el usuario autenticado es igual al usuario que escribio el post
        if($user->id == $post->user_id){
            return true;
        }else{
            return false;
        }

    }

    // el parametro user es obligatorio, pero al ponerle el signo de interrogacion se vuelve campo opcional para que de esta manera se pueda acceder a ver un post sin estar logeado
    public function published(?User $user, Post $post){
        if($post->status == 2){
            return true;
        }else{
            return false;
        }
    }
}
