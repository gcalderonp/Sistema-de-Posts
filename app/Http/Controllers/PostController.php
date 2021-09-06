<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

// importo el facade cache para hacer uso de cache
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(){


        // se pregunta si por la url se esta pasando informacion de la pagina

        if(request()->page){
            // si ya a sido enviada se almacena en una variable la key posts concatenado con el numero de pagina visitada
            $key = 'posts' . request()->page;
        }else{
            // caso contrario que solo almacene posts
            $key = 'posts';
        }
        // pregunta si esta almacenado en cache informacion con la clave posts
        if (Cache::has($key)) {
            // si es que existe info, la recupero en una variable
            $posts = Cache::get($key);
        } else {
            // caso contrario genero la consulta y la almaceno en cache
            $posts = Post::where('status', 2)->latest('id')->paginate(8);
            Cache::put($key, $posts);
        }

        return view('post.index', compact('posts'));
    }

    public function show(Post $post){

        $this->authorize('published', $post);

        //recupero los post que esten relacionados a la misma categoria y los que esten de estatus 2(publicado) ordenados por id de manera descendente, recupero solo 4 posts relacionados y creo la coleccion
        $similar = Post::where('category_id', $post->category_id)
        ->where('status', 2)
        ->where('id', '!=', $post->id)
        ->latest('id')
        ->take(4)
        ->get();

        return view('post.show', compact('post', 'similar'));
    }

    public function category(Category $category){
        $posts = Post::where('category_id', $category->id)->where('status', 2)->latest('id')->paginate(4);
        return view('post.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag){

        $posts = $tag->posts()->where('status',2)->latest('id')->paginate(4);

        return view('post.tag', compact('posts', 'tag'));
    }
}
