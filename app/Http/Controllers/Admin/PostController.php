<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        // asi protege todas las rutas del admin
        // $this->middleware('can:admin.users.index');
        // asi protege solo al metodo index
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {
        // el metodo pluck genera un array y solo toma los elementos del campo name y la clave es el id [clave: valor], no se usa el all ya que este devuelve un objeto y laravelcollectivs solo entiende array
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    // se le cambia de request a postrequest para que haga las validaciones en el request
    public function store(PostRequest $request)
    {

        $post = Post::create($request->all());


        // si se esta subiendo una imagen
        if($request->file('file')){
            // que se mueva la imagen de la carpeta temporal a la carpeta file dentro de la carpeta storage
            $url = Storage::put('public/posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }

        // elimina datos en cache
        // Cache::forget('key');

        // este metodo elimina directamente todas las variables de cache
        Cache::flush();

        // pregunto si se esta enviando informacion de etiquetas
        if($request->tags){
            // recupero relacion de n a n situado en el modelo
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        // policy para validar que no pueda editar y un post que no le pertenece
        $this->authorize('author', $post);
        $categories = Category::pluck('name', 'id');

        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostRequest $request, Post $post)
    {
        // policy para validar que no pueda editar y un post que no le pertenece
        $this->authorize('author', $post);

        $post->update($request->all());

        if($request->file('file')){
            $url = Storage::put('public/posts', $request->file('file'));

            // pregunta si tenia una imagen ese post
            if($post->image){
                // si la tenia la eliminamos
                Storage::delete($post->image->url);

                $post->image->update([
                    'url' => $url
                ]);
            }else{
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        // elimina datos en cache
        // Cache::forget('key');

        // este metodo elimina directamente todas las variables de cache
        Cache::flush();

        return redirect()->route('admin.posts.edit', $post)->with('info', 'Post Actualizado con Exito');

    }

    public function destroy(Post $post)
    {
        // policy para validar que no pueda editar y un post que no le pertenece
        $this->authorize('author', $post);
        $post->delete();

        // elimina datos en cache
        // Cache::forget('key');

        // este metodo elimina directamente todas las variables de cache
        Cache::flush();
        
        return redirect()->route('admin.posts.index');
    }
}
