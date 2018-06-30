<?php

use Illuminate\Database\Seeder;

class KindTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Kind::class, 4)->create();
    }
}
