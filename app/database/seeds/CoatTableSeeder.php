<?php

class CoatTableSeeder extends Seeder {

    public function run()
    {
        DB::table('coats')->delete();

        Coat::create(array('id' => 1, 'description' => 'Largo'));
        Coat::create(array('id' => 2, 'description' => 'Áspero'));
        Coat::create(array('id' => 3, 'description' => 'Rizado'));
        Coat::create(array('id' => 4, 'description' => 'Mechones'));
        Coat::create(array('id' => 5, 'description' => 'Sin pelo'));
        Coat::create(array('id' => 6, 'description' => 'Corto'));
    }

}
