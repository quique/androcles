<?php

// See http://laravel.com/docs/migrations#database-seeding

class VolunteerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('volunteers')->delete();

        Volunteer::create(array(
            'id' => 1,
            'alias' => 'BOFH',
            'task' => 'Admin',
            'description' => '',
            'photo' => 'nopic.jpg',
            'publish'   => 0,
        ));
    }

}
