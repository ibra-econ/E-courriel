<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Annotation;
use App\Models\Config;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Imputation;
use App\Models\Journal;
use App\Models\Nature;
use App\Models\Poste;
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

        Config::factory()->create();
        Departement::factory(5)->create();
        Poste::factory(5)->create();
        User::factory(5)->create();
        Poste::factory(2)->create();
        Journal::factory(10)->create();
        Nature::factory(5)->create();
        Correspondant::factory(10)->create();
        Annotation::factory(5)->create();
        Courrier::factory(5)->create();
        Imputation::factory(5)->create();

    }
}
