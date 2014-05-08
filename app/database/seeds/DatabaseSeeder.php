<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('CoatTableSeeder');

        $this->call('ColorTableSeeder');

        $this->call('SexTableSeeder');

        $this->call('SpeciesTableSeeder');

        $this->call('StatusTableSeeder');

        $this->call('SentryTableSeeder');
    }

}
