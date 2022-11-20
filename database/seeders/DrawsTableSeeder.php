<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DrawsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('draws')->delete();
        
        \DB::table('draws')->insert(array (
            0 => 
            array (
                'id' => 24,
                'game_id' => 49,
                'score' => 100,
                'mail' => 'Jamal@gmail.com',
                'team' => 'Jamal basket',
                'created_at' => '2022-09-29 13:22:51',
                'updated_at' => '2022-09-29 13:23:15',
                'status' => 'accepted',
            ),
            1 => 
            array (
                'id' => 25,
                'game_id' => 49,
                'score' => 100,
                'mail' => 'jbull635@gmail.com',
                'team' => 'Team-De-Basket',
                'created_at' => '2022-09-29 13:22:52',
                'updated_at' => '2022-09-29 13:23:15',
                'status' => 'accepted',
            ),
            2 => 
            array (
                'id' => 26,
                'game_id' => 55,
                'score' => 20,
                'mail' => 'jbull635@gmail.com',
                'team' => 'Team-De-Basket',
                'created_at' => '2022-09-30 09:42:32',
                'updated_at' => '2022-09-30 09:42:43',
                'status' => 'accepted',
            ),
            3 => 
            array (
                'id' => 27,
                'game_id' => 55,
                'score' => 20,
                'mail' => 'Jamal@gmail.com',
                'team' => 'Jamal basket',
                'created_at' => '2022-09-30 09:42:32',
                'updated_at' => '2022-09-30 09:42:43',
                'status' => 'accepted',
            ),
        ));
        
        
    }
}