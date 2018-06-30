<?php

use Illuminate\Database\Seeder;

class PayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pay::class, 2000)->create();
    }
}
