<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeamRatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('team_rates')->delete();
        
        \DB::table('team_rates')->insert(array (
            0 => 
            array (
                'id' => 66,
                'wichteamrated' => 'Jamal Foot',
                'punctuality' => 4.0,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-24 14:01:19',
                'updated_at' => '2022-09-24 14:03:19',
                'status' => 'pending',
                'team_rated_name' => 'Real Team',
                'game_id' => 45,
            ),
            1 => 
            array (
                'id' => 67,
                'wichteamrated' => 'Real Team',
                'punctuality' => 4.0,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-24 14:01:37',
                'updated_at' => '2022-09-24 14:03:19',
                'status' => 'accepted',
                'team_rated_name' => 'Jamal Foot',
                'game_id' => 45,
            ),
            2 => 
            array (
                'id' => 72,
                'wichteamrated' => 'Team-De-Basket',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-29 13:19:02',
                'updated_at' => '2022-09-29 13:19:02',
                'status' => 'pending',
                'team_rated_name' => 'Jamal basket',
                'game_id' => 48,
            ),
            3 => 
            array (
                'id' => 73,
                'wichteamrated' => 'Jamal basket',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-29 13:20:19',
                'updated_at' => '2022-09-29 13:20:19',
                'status' => 'accepted',
                'team_rated_name' => 'Team-De-Basket',
                'game_id' => 48,
            ),
            4 => 
            array (
                'id' => 74,
                'wichteamrated' => 'Team-De-Basket',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-29 13:22:52',
                'updated_at' => '2022-09-29 13:22:52',
                'status' => 'pending',
                'team_rated_name' => 'Jamal basket',
                'game_id' => 49,
            ),
            5 => 
            array (
                'id' => 75,
                'wichteamrated' => 'Jamal basket',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-29 13:23:15',
                'updated_at' => '2022-09-29 13:23:15',
                'status' => 'accepted',
                'team_rated_name' => 'Team-De-Basket',
                'game_id' => 49,
            ),
            6 => 
            array (
                'id' => 76,
                'wichteamrated' => 'Team-De-Basket',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-29 13:26:21',
                'updated_at' => '2022-09-29 13:40:31',
                'status' => 'pending',
                'team_rated_name' => 'Jamal basket',
                'game_id' => 50,
            ),
            7 => 
            array (
                'id' => 77,
                'wichteamrated' => 'Jamal basket',
                'punctuality' => 2.5,
                'fair_play' => 5.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-29 13:40:55',
                'updated_at' => '2022-09-29 13:40:55',
                'status' => 'accepted',
                'team_rated_name' => 'Team-De-Basket',
                'game_id' => 50,
            ),
            8 => 
            array (
                'id' => 78,
                'wichteamrated' => 'Jamal Foot',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-29 13:43:01',
                'updated_at' => '2022-09-29 13:43:54',
                'status' => 'pending',
                'team_rated_name' => 'Real Team',
                'game_id' => 51,
            ),
            9 => 
            array (
                'id' => 79,
                'wichteamrated' => 'Real Team',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-29 13:44:11',
                'updated_at' => '2022-09-29 13:44:11',
                'status' => 'accepted',
                'team_rated_name' => 'Jamal Foot',
                'game_id' => 51,
            ),
            10 => 
            array (
                'id' => 80,
                'wichteamrated' => 'Real Team',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-30 09:08:58',
                'updated_at' => '2022-09-30 09:08:58',
                'status' => 'pending',
                'team_rated_name' => 'Jamal Foot',
                'game_id' => 52,
            ),
            11 => 
            array (
                'id' => 81,
                'wichteamrated' => 'Jamal Foot',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-30 09:09:25',
                'updated_at' => '2022-09-30 09:09:25',
                'status' => 'accepted',
                'team_rated_name' => 'Real Team',
                'game_id' => 52,
            ),
            12 => 
            array (
                'id' => 82,
                'wichteamrated' => 'Real Team',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-30 09:11:39',
                'updated_at' => '2022-09-30 09:11:39',
                'status' => 'pending',
                'team_rated_name' => 'Jamal Foot',
                'game_id' => 53,
            ),
            13 => 
            array (
                'id' => 83,
                'wichteamrated' => 'Jamal Foot',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-30 09:12:05',
                'updated_at' => '2022-09-30 09:12:05',
                'status' => 'accepted',
                'team_rated_name' => 'Real Team',
                'game_id' => 53,
            ),
            14 => 
            array (
                'id' => 84,
                'wichteamrated' => 'Jamal basket',
                'punctuality' => 2.5,
                'fair_play' => 5.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-30 09:40:05',
                'updated_at' => '2022-09-30 09:40:05',
                'status' => 'pending',
                'team_rated_name' => 'Team-De-Basket',
                'game_id' => 54,
            ),
            15 => 
            array (
                'id' => 85,
                'wichteamrated' => 'Team-De-Basket',
                'punctuality' => 2.5,
                'fair_play' => 5.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-30 09:40:45',
                'updated_at' => '2022-09-30 09:40:45',
                'status' => 'accepted',
                'team_rated_name' => 'Jamal basket',
                'game_id' => 54,
            ),
            16 => 
            array (
                'id' => 86,
                'wichteamrated' => 'Jamal basket',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-30 09:42:01',
                'updated_at' => '2022-09-30 09:42:32',
                'status' => 'pending',
                'team_rated_name' => 'Team-De-Basket',
                'game_id' => 55,
            ),
            17 => 
            array (
                'id' => 87,
                'wichteamrated' => 'Team-De-Basket',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-09-30 09:42:42',
                'updated_at' => '2022-09-30 09:42:42',
                'status' => 'accepted',
                'team_rated_name' => 'Jamal basket',
                'game_id' => 55,
            ),
            18 => 
            array (
                'id' => 88,
                'wichteamrated' => 'Real Team',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-10-01 19:42:59',
                'updated_at' => '2022-10-01 19:42:59',
                'status' => 'pending',
                'team_rated_name' => 'Jamal Foot',
                'game_id' => 56,
            ),
            19 => 
            array (
                'id' => 89,
                'wichteamrated' => 'Jamal Foot',
                'punctuality' => 2.5,
                'fair_play' => 4.0,
                'teamrated' => 0.0,
                'created_at' => '2022-10-01 19:43:37',
                'updated_at' => '2022-10-01 19:43:37',
                'status' => 'accepted',
                'team_rated_name' => 'Real Team',
                'game_id' => 56,
            ),
        ));
        
        
    }
}