<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Agenda;
use App\Models\Annotation;
use App\Models\Config;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Diffusion;
use App\Models\Imputation;
use App\Models\Journal;
use App\Models\Nature;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Notifications\Notification;

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
        User::factory(5)->create();
        Nature::factory(5)->create();
        Correspondant::factory(5)->create();
        Annotation::factory(5)->create();
        Courrier::factory(5)->create();
        Imputation::factory(5)->create();
        Agenda::factory(15)->create();
        Journal::factory(10)->create();

        $departement = Departement::factory()
        ->has(User::factory()->count(10), 'users')
        ->create();

        $user = User::factory()
        ->has(Courrier::factory()->count(10), 'courriers')
        ->has(Imputation::factory()->count(10), 'imputations')
        ->has(Journal::factory()->count(5), 'journals')
        // ->has(Notification::factory()->count(5), 'journals')
        ->create();

    }
}
