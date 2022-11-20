<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notification_tokens')->delete();
        
        \DB::table('notification_tokens')->insert(array (
            0 => 
            array (
                'id' => 4,
                'email' => 'Jamal@gmail.com',
                'token' => 'ExponentPushToken[sd6pmnOxBgxCLO0Gv_2YFU]',
                'created_at' => '2022-08-19 18:02:30',
                'updated_at' => '2022-11-19 20:08:26',
            ),
            1 => 
            array (
                'id' => 5,
                'email' => 'jbull635@gmail.com',
                'token' => 'ExponentPushToken[VU4r7yDztrD9LqE9-Gidfe]',
                'created_at' => '2022-08-19 18:02:46',
                'updated_at' => '2022-09-30 09:26:59',
            ),
            2 => 
            array (
                'id' => 9,
                'email' => 'Jamal@gmail.com',
                'token' => 'undefined',
                'created_at' => '2022-09-19 10:56:14',
                'updated_at' => '2022-11-17 14:05:44',
            ),
            3 => 
            array (
                'id' => 10,
                'email' => 'Jamal@gmail.com',
                'token' => 'ExponentPushToken[de4JDKB_3ouyY_l6uERkN-]',
                'created_at' => '2022-10-01 19:36:08',
                'updated_at' => '2022-10-01 19:45:12',
            ),
        ));
        
        
    }
}