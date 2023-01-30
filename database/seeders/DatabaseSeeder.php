<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(MovieSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(TvshowSeeder::class);
        $this->call(MovieStaffSeeder::class);
        $this->call(SeasonSeeder::class);
        $this->call(EpisodeSeeder::class);
        $this->call(TvshowStaffSeeder::class);
        $this->call(UserSeeder::class);
    }
}
