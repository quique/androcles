<?php

class SexTableSeeder extends Seeder {

    public function run()
    {
        DB::table('sexes')->delete();

        $sexes = [
            ['id' => 1, 'name' => 'Macho'],
            ['id' => 2, 'name' => "Desconocido"],
            ['id' => 3, 'name' => "Hembra"],
        ];

        DB::table('sexes')->insert($sexes);
    }

}
