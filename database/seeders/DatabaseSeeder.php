<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\DataSource;
use App\Models\User;
use App\Providers\NewsApiServiceProvider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

        DataSource::factory()->create([
            'name' => 'NewsApi',
            'provider' => 'App\Providers\NewsApiServiceProvider',
        ]);

        $this->call(SourcesTableSeeder::class);
    }
}
