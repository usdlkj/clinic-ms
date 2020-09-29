<?php

namespace Database\Seeders;

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
        
        $this->call([
            UserSeeder::class,
        ]);
        \App\Models\User::factory(20)->create();
        \App\Models\Patient::factory()
            ->times(50)
            ->hasVisits(20)
            ->create();
    }
}
