<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefeatsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('defeats')->delete();
        
        \DB::table('defeats')->insert(array (
            0 => 
            array (
                'id' => 1,
                'game_id' => 19,
                'score' => 5,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-03 10:37:56',
                'updated_at' => '2022-09-03 10:37:56',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            1 => 
            array (
                'id' => 2,
                'game_id' => 19,
                'score' => 5,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-03 10:37:56',
                'updated_at' => '2022-09-03 10:37:56',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            2 => 
            array (
                'id' => 3,
                'game_id' => 19,
                'score' => 4,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-03 10:37:56',
                'updated_at' => '2022-09-03 10:37:56',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            3 => 
            array (
                'id' => 4,
                'game_id' => 19,
                'score' => 7,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-03 10:37:56',
                'updated_at' => '2022-09-03 10:37:56',
                'score_2' => 1,
                'status' => 'accepted',
            ),
            4 => 
            array (
                'id' => 5,
                'game_id' => 19,
                'score' => 7,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-03 10:37:56',
                'updated_at' => '2022-09-03 10:37:56',
                'score_2' => 2,
                'status' => 'accepted',
            ),
            5 => 
            array (
                'id' => 6,
                'game_id' => 19,
                'score' => 5,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-03 10:37:56',
                'updated_at' => '2022-09-03 10:37:56',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            6 => 
            array (
                'id' => 7,
                'game_id' => 19,
                'score' => 5,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-03 10:37:56',
                'updated_at' => '2022-09-03 10:37:56',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            7 => 
            array (
                'id' => 8,
                'game_id' => 21,
                'score' => 6,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 2,
                'status' => 'accepted',
            ),
            8 => 
            array (
                'id' => 9,
                'game_id' => 21,
                'score' => 4,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 1,
                'status' => 'accepted',
            ),
            9 => 
            array (
                'id' => 10,
                'game_id' => 21,
                'score' => 5,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            10 => 
            array (
                'id' => 11,
                'game_id' => 21,
                'score' => 6,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            11 => 
            array (
                'id' => 12,
                'game_id' => 21,
                'score' => 7,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 1,
                'status' => 'accepted',
            ),
            12 => 
            array (
                'id' => 13,
                'game_id' => 21,
                'score' => 7,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            13 => 
            array (
                'id' => 14,
                'game_id' => 21,
                'score' => 4,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 1,
                'status' => 'accepted',
            ),
            14 => 
            array (
                'id' => 15,
                'game_id' => 21,
                'score' => 5,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 2,
                'status' => 'accepted',
            ),
            15 => 
            array (
                'id' => 16,
                'game_id' => 21,
                'score' => 7,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            16 => 
            array (
                'id' => 17,
                'game_id' => 21,
                'score' => 5,
                'looser_mail' => 'Paris@gmail.com',
                'looser_team' => 'Paris Basket',
                'created_at' => '2022-09-03 10:40:05',
                'updated_at' => '2022-09-03 10:40:05',
                'score_2' => 1,
                'status' => 'accepted',
            ),
            17 => 
            array (
                'id' => 66,
                'game_id' => 23,
                'score' => 0,
                'looser_mail' => 'jbull635@gmail.com',
                'looser_team' => 'Team-De-Basket',
                'created_at' => '2022-09-24 11:12:18',
                'updated_at' => '2022-09-24 11:12:18',
                'score_2' => 2,
                'status' => 'pending',
            ),
            18 => 
            array (
                'id' => 84,
                'game_id' => 45,
                'score' => 2,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-24 14:01:19',
                'updated_at' => '2022-09-24 14:03:19',
                'score_2' => 4,
                'status' => 'accepted',
            ),
            19 => 
            array (
                'id' => 85,
                'game_id' => 48,
                'score' => 18,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal basket',
                'created_at' => '2022-09-29 13:19:02',
                'updated_at' => '2022-09-29 13:20:19',
                'score_2' => 25,
                'status' => 'accepted',
            ),
            20 => 
            array (
                'id' => 104,
                'game_id' => 50,
                'score' => 100,
                'looser_mail' => 'jbull635@gmail.com',
                'looser_team' => 'Team-De-Basket',
                'created_at' => '2022-09-29 13:40:30',
                'updated_at' => '2022-09-29 13:40:55',
                'score_2' => 25,
                'status' => 'accepted',
            ),
            21 => 
            array (
                'id' => 106,
                'game_id' => 51,
                'score' => 1,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-29 13:43:54',
                'updated_at' => '2022-09-29 13:44:11',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            22 => 
            array (
                'id' => 107,
                'game_id' => 52,
                'score' => 2,
                'looser_mail' => 'jbull635@gmail.com',
                'looser_team' => 'Real Team',
                'created_at' => '2022-09-30 09:08:58',
                'updated_at' => '2022-09-30 09:09:25',
                'score_2' => 4,
                'status' => 'accepted',
            ),
            23 => 
            array (
                'id' => 108,
                'game_id' => 53,
                'score' => 2,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-09-30 09:11:38',
                'updated_at' => '2022-09-30 09:12:05',
                'score_2' => 5,
                'status' => 'accepted',
            ),
            24 => 
            array (
                'id' => 109,
                'game_id' => 54,
                'score' => 10,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal basket',
                'created_at' => '2022-09-30 09:40:04',
                'updated_at' => '2022-09-30 09:40:45',
                'score_2' => 9,
                'status' => 'accepted',
            ),
            25 => 
            array (
                'id' => 111,
                'game_id' => 56,
                'score' => 1,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-10-01 19:42:58',
                'updated_at' => '2022-10-01 19:43:37',
                'score_2' => 3,
                'status' => 'accepted',
            ),
            26 => 
            array (
                'id' => 156,
                'game_id' => 101,
                'score' => 2,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-10-06 08:37:50',
                'updated_at' => '2022-10-06 08:37:50',
                'score_2' => 6,
                'status' => 'accepted',
            ),
            27 => 
            array (
                'id' => 157,
                'game_id' => 102,
                'score' => 3,
                'looser_mail' => 'jbull635@gmail.com',
                'looser_team' => 'Real Team',
                'created_at' => '2022-10-06 08:46:32',
                'updated_at' => '2022-10-06 08:46:32',
                'score_2' => 6,
                'status' => 'accepted',
            ),
            28 => 
            array (
                'id' => 158,
                'game_id' => 103,
                'score' => 2,
                'looser_mail' => 'jbull635@gmail.com',
                'looser_team' => 'Real Team',
                'created_at' => '2022-10-06 11:20:06',
                'updated_at' => '2022-10-06 11:20:06',
                'score_2' => 7,
                'status' => 'accepted',
            ),
            29 => 
            array (
                'id' => 159,
                'game_id' => 104,
                'score' => 2,
                'looser_mail' => 'jbull635@gmail.com',
                'looser_team' => 'Real Team',
                'created_at' => '2022-10-06 11:21:20',
                'updated_at' => '2022-10-06 11:21:20',
                'score_2' => 4,
                'status' => 'accepted',
            ),
            30 => 
            array (
                'id' => 160,
                'game_id' => 105,
                'score' => 2,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-10-06 11:25:51',
                'updated_at' => '2022-10-06 11:25:51',
                'score_2' => 6,
                'status' => 'accepted',
            ),
            31 => 
            array (
                'id' => 161,
                'game_id' => 106,
                'score' => 1,
                'looser_mail' => 'Jamal@gmail.com',
                'looser_team' => 'Jamal Foot',
                'created_at' => '2022-10-06 11:26:30',
                'updated_at' => '2022-10-06 11:26:30',
                'score_2' => 6,
                'status' => 'accepted',
            ),
        ));
        
        
    }
}