<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserTableSeeder::class);
        $this->command->info('The user table was successfully loaded with data!');

        $this->call(AuthorTableSeeder::class);
        $this->command->info('The author table was successfully loaded with data!');

        $this->call(BookTableSeeder::class);
        $this->command->info('The book table was successfully loaded with data!');
    }
}
