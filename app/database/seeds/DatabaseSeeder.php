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
        $this->command->info('Coats table seeded!');

        $this->call('ColorTableSeeder');
        $this->command->info('Colors table seeded!');

        $this->call('SexTableSeeder');
        $this->command->info('Sexes table seeded!');

        $this->call('SpeciesTableSeeder');
        $this->command->info('Species table seeded!');

        $this->call('StatusTableSeeder');
        $this->command->info('Statuses table seeded!');
    }

}
