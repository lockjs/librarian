<?php

use Phinx\Seed\AbstractSeed;

class Books extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];

        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'pg_ID'     => $faker->unique()->randomNumber(3),
                'title'     => $faker->words(random_int(1, 5), true),
                'authors'   => $faker->lastName . '. ' . $faker->firstName . ', ' . $faker->year . '-' . $faker->year,
                'source'    => 'seed_script',
            ];
        }

        $this->table('books')->insert($data)->saveData();
    }
}
