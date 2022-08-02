<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Annotation;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Nature;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        User::factory(10)->create();
        Nature::factory(5)->create();
        Annotation::factory(5)->create();
        Departement::factory(5)->create(
            [ 'user_id' => mt_rand(1,3)]
        );

        // Courrier::factory(10)->create(
        //     [ 'role_id' => mt_rand(1,3)]
        //  );
    }
}
