<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url'];
    //relacion polimorfica
    public function imageable(){ //el nombre debe ser al de la tabla
        return $this->morphTo(); //digo que acepte relacion polimorfica
    }
}
