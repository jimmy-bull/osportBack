<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestingTablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('testing_tables')->delete();
        
        \DB::table('testing_tables')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Miss Kristy Deckow',
                'lat' => 6131,
                'created_at' => '2022-07-08 14:11:52',
                'updated_at' => '2022-07-08 14:11:52',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Robbie Trantow',
                'lat' => 4359,
                'created_at' => '2022-07-08 14:13:00',
                'updated_at' => '2022-07-08 14:13:00',
            ),
        ));
        
        
    }
}