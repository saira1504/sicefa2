<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuario Nataly (solo si no existe)
        $nataly = Person::where('document_number', '123456789')->first();
        if ($nataly) {
            User::firstOrCreate(
                ['email' => 'nataly@gmail.com'],
                [
                    'person_id' => $nataly->id,
                    'nickname' => 'nataly',
                    'password' => Hash::make('123456789')
                ]
            );
        }

        // Crear usuario Lola (solo si no existe)
        $person = Person::where('document_number', 52829681)->first();
        if ($person) {
            User::firstOrCreate(
                ['email' => 'lolafernandaherrera@gmail.com'],
                [
                    'person_id' => $person->id,
                    'nickname' => 'Lola' //Lohe9681
                ]
            );
        }
    }
}
