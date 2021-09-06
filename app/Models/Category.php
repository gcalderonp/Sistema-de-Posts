<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    //relacion 1 a n con post
    public function posts(){
        return $this->hasMany(Post::class);
    }

    //url amigables, toma el slug y no el id de la categoria
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
