<?php

use App\Expenses as ExpensesModel;
use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Truncate entries if exist to start from scratch
        ExpensesModel::truncate();

        $faker = \Faker\Factory::create();

        // Create random entries for our expenses table:
        for ($i = 0; $i < 50; $i++) {
            ExpensesModel::create([
                'description' => $faker->realText(),
                'cost' => $faker->numberBetween(1, 10000),
                'currency' => 'RON',
                'date' => $faker->date('Y-m-d')

            ]);
        }
    }
}
