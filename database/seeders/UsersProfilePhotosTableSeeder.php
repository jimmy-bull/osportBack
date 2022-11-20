<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersProfilePhotosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users__profile__photos')->delete();
        
        \DB::table('users__profile__photos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => 'jbull635@gmail.com',
                'image' => 'public/profils_photos/ZFklEbmZfGLGKQ6mQhJYaVkaaIzxTsBhPUyHyfsW.jpg',
                'created_at' => '2022-06-26 20:55:20',
                'updated_at' => '2022-11-17 19:29:53',
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'Lyon@gmail.com',
                'image' => 'public/profils_photos/dlHnQo1HYNklAslXLubm5Ow76xTAs98cioMJA49c.jpg',
                'created_at' => '2022-07-01 17:11:44',
                'updated_at' => '2022-07-14 18:20:48',
            ),
            2 => 
            array (
                'id' => 3,
                'email' => 'Jamal@gmail.com',
                'image' => 'public/profils_photos/75QAv1jWq5Z6JlWSywAVBx6dIZ0A2KFdYAcBG9OL.jpg',
                'created_at' => '2022-07-01 17:23:51',
                'updated_at' => '2022-11-14 21:05:14',
            ),
            3 => 
            array (
                'id' => 4,
                'email' => 'Paris@gmail.com',
                'image' => 'public/profils_photos/NCGV15SLubm6BOG9ev68c355poiPHlP3OVzI1DkI.jpg',
                'created_at' => '2022-07-01 17:29:24',
                'updated_at' => '2022-09-01 04:59:20',
            ),
            4 => 
            array (
                'id' => 5,
                'email' => 'Lille@gmail.com',
                'image' => 'public/profils_photos/x82TepzmEGzgvwG6NlswTICPOfWzYkt8PYST1V2C.jpg',
                'created_at' => '2022-09-01 05:03:37',
                'updated_at' => '2022-09-01 05:03:37',
            ),
            5 => 
            array (
                'id' => 6,
                'email' => 'rrunte@example.com',
                'image' => 'public/profils_photos/DMsmnvXGsa6AMoXKrzomaLHbbasenCHxInNLmLJ3.jpg',
                'created_at' => '2022-09-01 05:13:05',
                'updated_at' => '2022-09-01 05:13:34',
            ),
            6 => 
            array (
                'id' => 7,
                'email' => 'perry.stanton@example.org',
                'image' => 'public/profils_photos/wo6HANkWl7ymUS3mc6unEhGNzhLSZMsvla2LBfed.jpg',
                'created_at' => '2022-09-01 05:54:00',
                'updated_at' => '2022-09-01 05:54:00',
            ),
        ));
        
        
    }
}