<?php

class StatusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('statuses')->delete();

        $statuses = [
            [
                'id'   => 1,
                'name' => 'En adopción',
            ],
            [
                'id'   => 3,
                'name' => "En casa de acogida",
            ],
            [
                'id'   => 5,
                'name' => "Próximamente en adopción",
            ],
            [
                'id'   => 10,
                'name' => "Reservado",
            ],
            [
                'id'   => 13,
                'name' => "Encontrado (se busca al propietario)",
            ],
            [
                'id'   => 14,
                'name' => "Particular en difusión",
            ],
            [
                'id'   => 15,
                'name' => "¡Adoptado!",
            ],
            [
                'id'   => 18,
                'name' => "Liberado",
            ],
            [
                'id'   => 20,
                'name' => "Reclamado por el dueño",
            ],
            [
                'id'   => 25,
                'name' => "Extraviado (se busca el animal)",
            ],
            [
                'id'   => 30,
                'name' => "Robado",
            ],
            [
                'id'   => 35,
                'name' => "Fallecido",
            ],
            [
                'id'   => 40,
                'name' => "Sacrificado",
            ],
        ];

        DB::table('statuses')->insert($statuses);
    }

}
