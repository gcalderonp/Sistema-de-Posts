<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage; //importe para crear una carpeta
use Prophecy\Call\Call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/posts');//al ejecutar los seedes mas de una vez se me va a llenar de imagenes, entonces para evitar eso l que se hace es eliminar esa carpeta y despues la vuelvo a crear con la linea de abajo
        Storage::makeDirectory('public/posts'); //creo carpeta para guardar las imagenes

        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
        Category::factory(4)->create();
        Tag::factory(8)->create();
        $this->call(PostSeeder::class);
    }
}
