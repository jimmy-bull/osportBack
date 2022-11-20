<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MypostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('myposts')->delete();
        
        
        
    }
}