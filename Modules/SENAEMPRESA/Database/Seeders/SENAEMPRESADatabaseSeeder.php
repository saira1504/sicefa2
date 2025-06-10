<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\DB;
use Modules\SENAEMPRESA\Database\Seeders\PeopleTableSeeder;

class SENAEMPRESADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PeopleTableSeeder::class,
            UsersTableSeeder::class,
            AppTableSeeder::class,
            QuartersTableSeeder::class,
            PositionCompaniesTableSeeder::class,
            VacanciesTableSeeder::class,
            InventoriesTableSeeder::class,
            SenaempresasTableSeeder::class,
        ]);
    }
}
