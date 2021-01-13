<?php

use App\Models\Admin\Book;
use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Book::class, 100)->create();
        $faker = Faker\Factory::create();
        Book::all()->each(static function (Book $book) use ($faker) {
            $authors = [];
            for ($i = 0; $i <= 20; $i++) {
                $authors[] = $faker->numberBetween(1, 20);
                $book->authors()->sync($authors); // BelongsToMany
            }
        });
    }
}
