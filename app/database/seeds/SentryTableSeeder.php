<?php

class SentryTableSeeder extends Seeder {

    public function run()
    {
        // Wipe the table clean before populating
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();

        Sentry::getUserProvider()->create(array(
            'email'       => 'root@localhost',
            'password'    => "admin",
            'first_name'  => 'Benevolent',
            'last_name'   => 'Dictator',
            'activated'   => 1,
        ));

        Sentry::getGroupProvider()->create([
            'name'        => 'Admin',
            'permissions' => [
                'users'          => 1,
                'animals.create' => 1,
                'animals.store'  => 1,
                'animals.edit'   => 1,
                'animals.update' => 1,
                'animals.remove' => 1,
                'animals.delete' => 1,
                'news.create'    => 1,
                'news.store'     => 1,
                'news.edit'      => 1,
                'news.update'    => 1,
                'news.remove'    => 1,
                'news.delete'    => 1,
            ],
        ]);

         Sentry::getGroupProvider()->create([
            'name'        => 'Editors',
            'permissions' => [
                'animals.create' => 1,
                'animals.store'  => 1,
                'animals.edit'   => 1,
                'animals.update' => 1,
                'animals.remove' => 1,
                'animals.delete' => 1,
                'news.create'    => 1,
                'news.store'     => 1,
                'news.edit'      => 1,
                'news.update'    => 1,
                'news.remove'    => 1,
                'news.delete'    => 1,
            ],
        ]);

        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('root@localhost');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);
    }

}

