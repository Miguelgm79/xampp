<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Array de usuarios a insertar
     */
    private $arrayUsuarios = array(
        array(
            'name' => 'miguel',
            'email' => 'miguel@gmail.com',
            'password' => '123_4'
        ),
        array(
            'name' => 'yolanda',
            'email' => 'yolanda@gmail.com',
            'password' => '123_4'
        ),
        array(
            'name' => 'joel',
            'email' => 'joel@gmail.com',
            'password' => '123_4'
        ),
        array(
            'name' => 'mario',
            'email' => 'mario@gmail.com',
            'password' => '123_4'
        ),
        array(
            'name' => 'moreno',
            'email' => 'moreno@gmail.com',
            'password' => '123_4'
        )
    );

    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->seedUsers();
        $this->command->info('Tabla usuarios inicializada con datos!');
    }

    private function seedUsers()
    {
        // Vaciamos la tabla por si ya tenía datos anteriormente
        // Desactivamos la revisión de claves foráneas por si hay relaciones (opcional, pero recomendado al vaciar tablas principales)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Iteramos sobre el array para crear los registros
        foreach( $this->arrayUsuarios as $usuario ) {
            $u = new User; // Usamos el modelo en singular y con mayúscula
            $u->name = $usuario['name'];
            $u->email = $usuario['email'];
            // Las contraseñas en Laravel DEBEN estar encriptadas (hasheadas)
            $u->password = bcrypt($usuario['password']); 
            
            // Los campos 'id' (autoincremental) y 'timestamps' (created_at, updated_at) 
            // los gestiona Eloquent automáticamente al hacer el save().
            // El 'remember_token' se queda nulo hasta que se use la función de "recordar sesión".
            
            $u->save();
        }
    }
}