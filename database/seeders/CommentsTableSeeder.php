<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'post_id' => 54,
                'comment' => 'Ronaldo est fini',
                'who_commented_id' => 26,
                'created_at' => '2022-11-18 11:46:21',
                'updated_at' => '2022-11-18 11:46:21',
            ),
            1 => 
            array (
                'id' => 2,
                'post_id' => 54,
                'comment' => 'Ce joueur est moins bon que messi',
                'who_commented_id' => 26,
                'created_at' => '2022-11-18 11:47:29',
                'updated_at' => '2022-11-18 11:47:29',
            ),
            2 => 
            array (
                'id' => 3,
                'post_id' => 55,
                'comment' => 'Drake est le meilleur rappeur actuellement',
                'who_commented_id' => 26,
                'created_at' => '2022-11-18 11:48:52',
                'updated_at' => '2022-11-18 11:48:52',
            ),
            3 => 
            array (
                'id' => 4,
                'post_id' => 54,
                'comment' => 'Moi je trouve qu’il n’est pas mal ',
                'who_commented_id' => 26,
                'created_at' => '2022-11-19 08:56:07',
                'updated_at' => '2022-11-19 08:56:07',
            ),
            4 => 
            array (
                'id' => 5,
                'post_id' => 54,
                'comment' => 'Un robot ',
                'who_commented_id' => 26,
                'created_at' => '2022-11-19 09:09:01',
                'updated_at' => '2022-11-19 09:09:01',
            ),
            5 => 
            array (
                'id' => 6,
                'post_id' => 54,
                'comment' => 'Moi je pense qu’il n’était pas bon ce Match dernier ',
                'who_commented_id' => 26,
                'created_at' => '2022-11-19 09:34:53',
                'updated_at' => '2022-11-19 09:34:53',
            ),
            6 => 
            array (
                'id' => 7,
                'post_id' => 54,
                'comment' => 'Un nouveau commentaire inutile 😂😂',
                'who_commented_id' => 26,
                'created_at' => '2022-11-19 12:11:13',
                'updated_at' => '2022-11-19 12:11:13',
            ),
            7 => 
            array (
                'id' => 8,
                'post_id' => 55,
                'comment' => 'Un commentaire sur Drake 😂🔥🤷🏾‍♂️',
                'who_commented_id' => 26,
                'created_at' => '2022-11-19 12:12:01',
                'updated_at' => '2022-11-19 12:12:01',
            ),
            8 => 
            array (
                'id' => 9,
                'post_id' => 55,
                'comment' => 'Encore moi 😂🔥🙏',
                'who_commented_id' => 26,
                'created_at' => '2022-11-19 12:12:17',
                'updated_at' => '2022-11-19 12:12:17',
            ),
            9 => 
            array (
                'id' => 10,
                'post_id' => 53,
                'comment' => 'Marseille un club moins bon que le PSG 😝 👌🏾🤷🏾‍♂️',
                'who_commented_id' => 26,
                'created_at' => '2022-11-19 12:23:23',
                'updated_at' => '2022-11-19 12:23:23',
            ),
            10 => 
            array (
                'id' => 11,
                'post_id' => 54,
                'comment' => 'Ok mange ',
                'who_commented_id' => 26,
                'created_at' => '2022-11-19 19:52:55',
                'updated_at' => '2022-11-19 19:52:55',
            ),
        ));
        
        
    }
}