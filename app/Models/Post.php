<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Image;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //relacion 1 a n inversa con user
    public function user(){
        return $this->belongsTo('App    \Models\User');
    }

    //relacion 1 a n inversa con category
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    //relacion n a n con tag
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //relacion 1 a 1 polimorfica con image
    public function image(){
        return $this->morphOne(Image::class, 'imageable'); //le paso el parametro del metodo a usar
    }
}
