<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_tables')->delete();
        
        \DB::table('post_tables')->insert(array (
            0 => 
            array (
                'id' => 48,
                'title' => 'Un Match incroyable du PSG🔥🔥👌🏾',
                'user_id' => 26,
                'who_can_see' => 'monde',
                'status' => 'online',
                'created_at' => '2022-11-14 21:01:54',
                'updated_at' => '2022-11-14 21:01:54',
            ),
            1 => 
            array (
                'id' => 52,
                'title' => 'Dump photo of girls ❤️😍💕',
                'user_id' => 1032,
                'who_can_see' => 'monde',
                'status' => 'online',
                'created_at' => '2022-11-15 18:05:02',
                'updated_at' => '2022-11-15 18:05:02',
            ),
            2 => 
            array (
                'id' => 53,
                'title' => 'Marseille pas très en forme actuellement 😩🙏',
                'user_id' => 1032,
                'who_can_see' => 'monde',
                'status' => 'online',
                'created_at' => '2022-11-15 18:06:20',
                'updated_at' => '2022-11-15 18:06:20',
            ),
            3 => 
            array (
                'id' => 54,
                'title' => 'Un Ronaldo qui revient 🤷🏾‍♂️👍🔥🔥🔥',
                'user_id' => 1032,
                'who_can_see' => 'monde',
                'status' => 'online',
                'created_at' => '2022-11-15 18:16:17',
                'updated_at' => '2022-11-15 18:16:17',
            ),
            4 => 
            array (
                'id' => 55,
                'title' => 'Drake photo Dump',
                'user_id' => 1032,
                'who_can_see' => 'monde',
                'status' => 'online',
                'created_at' => '2022-11-17 20:50:37',
                'updated_at' => '2022-11-17 20:50:37',
            ),
        ));
        
        
    }
}