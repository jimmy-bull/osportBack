<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('likes')->delete();
        
        \DB::table('likes')->insert(array (
            0 => 
            array (
                'id' => 2,
                'post_id' => 55,
                'who_liked_id' => 1032,
                'created_at' => '2022-11-18 09:33:25',
                'updated_at' => '2022-11-18 09:33:25',
            ),
            1 => 
            array (
                'id' => 3,
                'post_id' => 54,
                'who_liked_id' => 1032,
                'created_at' => '2022-11-18 09:34:16',
                'updated_at' => '2022-11-18 09:34:16',
            ),
            2 => 
            array (
                'id' => 6,
                'post_id' => 54,
                'who_liked_id' => 26,
                'created_at' => '2022-11-18 11:32:36',
                'updated_at' => '2022-11-18 11:32:36',
            ),
            3 => 
            array (
                'id' => 8,
                'post_id' => 52,
                'who_liked_id' => 26,
                'created_at' => '2022-11-18 20:51:47',
                'updated_at' => '2022-11-18 20:51:47',
            ),
            4 => 
            array (
                'id' => 11,
                'post_id' => 53,
                'who_liked_id' => 26,
                'created_at' => '2022-11-18 21:14:50',
                'updated_at' => '2022-11-18 21:14:50',
            ),
            5 => 
            array (
                'id' => 12,
                'post_id' => 55,
                'who_liked_id' => 26,
                'created_at' => '2022-11-18 21:57:34',
                'updated_at' => '2022-11-18 21:57:34',
            ),
        ));
        
        
    }
}