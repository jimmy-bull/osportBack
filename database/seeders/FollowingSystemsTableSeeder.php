<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FollowingSystemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('following_systems')->delete();
        
        \DB::table('following_systems')->insert(array (
            0 => 
            array (
                'id' => 8,
                'thefollower' => 'jbull635@gmail.com',
                'thefollowed' => 'Jamal@gmail.com',
                'thefollowingState' => 'isfollowing',
                'created_at' => '2022-07-27 09:57:20',
                'updated_at' => '2022-08-21 16:34:23',
            ),
            1 => 
            array (
                'id' => 9,
                'thefollower' => 'jbull635@gmail.com',
                'thefollowed' => 'Lille@gmail.com',
                'thefollowingState' => 'isfollowing',
                'created_at' => '2022-07-27 09:57:54',
                'updated_at' => '2022-07-27 12:43:43',
            ),
            2 => 
            array (
                'id' => 10,
                'thefollower' => 'jbull635@gmail.com',
                'thefollowed' => 'Paris@gmail.com',
                'thefollowingState' => 'isfollowing',
                'created_at' => '2022-07-27 10:06:45',
                'updated_at' => '2022-07-27 13:08:58',
            ),
            3 => 
            array (
                'id' => 11,
                'thefollower' => 'jbull635@gmail.com',
                'thefollowed' => 'icremin@example.org',
                'thefollowingState' => 'isfollowing',
                'created_at' => '2022-07-27 12:43:51',
                'updated_at' => '2022-07-27 12:43:57',
            ),
            4 => 
            array (
                'id' => 12,
                'thefollower' => 'jbull635@gmail.com',
                'thefollowed' => 'carley93@example.net',
                'thefollowingState' => 'isfollowing',
                'created_at' => '2022-07-27 12:44:02',
                'updated_at' => '2022-07-27 12:44:02',
            ),
            5 => 
            array (
                'id' => 13,
                'thefollower' => 'jbull635@gmail.com',
                'thefollowed' => 'brianne83@example.org',
                'thefollowingState' => 'isfollowing',
                'created_at' => '2022-07-27 12:44:44',
                'updated_at' => '2022-07-27 12:44:44',
            ),
            6 => 
            array (
                'id' => 14,
                'thefollower' => 'jbull635@gmail.com',
                'thefollowed' => 'uschimmel@example.com',
                'thefollowingState' => 'isunfollowed',
                'created_at' => '2022-07-27 12:45:20',
                'updated_at' => '2022-07-27 12:45:22',
            ),
            7 => 
            array (
                'id' => 15,
                'thefollower' => 'Jamal@gmail.com',
                'thefollowed' => 'jbull635@gmail.com',
                'thefollowingState' => 'isfollowing',
                'created_at' => '2022-07-27 13:48:50',
                'updated_at' => '2022-09-17 21:29:41',
            ),
            8 => 
            array (
                'id' => 16,
                'thefollower' => 'Lille@gmail.com',
                'thefollowed' => 'jbull635@gmail.com',
                'thefollowingState' => 'isfollowing',
                'created_at' => '2022-09-01 05:04:40',
                'updated_at' => '2022-09-01 05:04:40',
            ),
        ));
        
        
    }
}