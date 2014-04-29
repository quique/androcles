<?php

class SpeciesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('species')->delete();

        $species = [
            [
                'id'         => 1,
                'name'       => 'Perro',
                'pluralname' => 'Perros',
            ],
            [
                'id'         => 2,
                'name'       => 'Gato',
                'pluralname' => 'Gatos',
            ],
            [
                'id'         => 3,
                'name'       => 'Ave',
                'pluralname' => 'Aves',
            ],
            [
                'id'         => 4,
                'name'       => 'Ratón',
                'pluralname' => 'Ratones',
            ],
            [
                'id'         => 5,
                'name'       => 'Rata',
                'pluralname' => 'Ratas',
            ],
            [
                'id'         => 6,
                'name'       => 'Erizo',
                'pluralname' => 'Erizos',
            ],
            [
                'id'         => 7,
                'name'       => 'Conejo',
                'pluralname' => 'Conejos',
            ],
            [
                'id'         => 8,
                'name'       => 'Paloma',
                'pluralname' => 'Palomas',
            ],
            [
                'id'         => 9,
                'name'       => 'Hurón',
                'pluralname' => 'Hurones',
            ],
            [
                'id'         => 10,
                'name'       => 'Chinchilla',
                'pluralname' => 'Chincillas',
            ],
            [
                'id'         => 11,
                'name'       => 'Serpiente',
                'pluralname' => 'Serpientes',
            ],
            [
                'id'         => 12,
                'name'       => 'Tortuga',
                'pluralname' => 'Tortugas',
            ],
            [
                'id'         => 13,
                'name'       => 'Galápago',
                'pluralname' => 'Galápagos',
            ],
            [
                'id'         => 14,
                'name'       => 'Pollo',
                'pluralname' => 'Pollos',
            ],
            [
                'id'         => 15,
                'name'       => 'Búho',
                'pluralname' => 'Búhos',
            ],
            [
                'id'         => 16,
                'name'       => 'Cabra',
                'pluralname' => 'Cabras',
            ],
            [
                'id'         => 17,
                'name'       => 'Oca',
                'pluralname' => 'Ocas',
            ],
            [
                'id'         => 18,
                'name'       => 'Gerbilino',
                'pluralname' => 'Gerbilinos',
            ],
            [
                'id'         => 19,
                'name'       => 'Cacatúa ninfa',
                'pluralname' => 'Cacatúas ninfa',
            ],
            [
                'id'         => 20,
                'name'       => 'Cobaya',
                'pluralname' => 'Cobayas',
            ],
            [
                'id'         => 21,
                'name'       => 'Pez',
                'pluralname' => 'Peces',
            ],
            [
                'id'         => 22,
                'name'       => 'Hámster',
                'pluralname' => 'Hámsters',
            ],
            [
                'id'         => 23,
                'name'       => 'Camello',
                'pluralname' => 'Camellos',
            ],
            [
                'id'         => 24,
                'name'       => 'Caballo',
                'pluralname' => 'Caballos',
            ],
            [
                'id'         => 25,
                'name'       => 'Poni',
                'pluralname' => 'Ponis',
            ],
            [
                'id'         => 26,
                'name'       => 'Burro',
                'pluralname' => 'Burros',
            ],
            [
                'id'         => 27,
                'name'       => 'Llama',
                'pluralname' => 'Llamas',
            ],
            [
                'id'         => 28,
                'name'       => 'Cerdo',
                'pluralname' => 'Cerdos',
            ],
        ];

        DB::table('species')->insert($species);
    }

}
