<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('Post')->delete();
        
        \DB::table('Post')->insert(array (
            0 => 
            array (
                'id' => 1,
                'post' => 'jimymy est le best',
            ),
            1 => 
            array (
                'id' => 2,
                'post' => 'tout est bien',
            ),
            2 => 
            array (
                'id' => 3,
                'post' => 'Bonne données',
            ),
        ));
        
        
    }
}