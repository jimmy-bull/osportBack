<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AskGamesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ask_games')->delete();
        
        \DB::table('ask_games')->insert(array (
            0 => 
            array (
                'id' => 19,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '18H30',
                'place_of_game' => 'Ville-d\'Avray ',
                'team_of_asker' => 'Jamal Foot',
                'team_of_who_was_asked' => 'Real Team',
                'created_at' => '2022-09-01 08:17:09',
                'updated_at' => '2022-09-22 11:30:18',
                'status' => 'no_actions',
            ),
            1 => 
            array (
                'id' => 20,
                'who_is_asking' => 'Paris@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '15H30',
                'place_of_game' => 'Marseille ',
                'team_of_asker' => 'Marseille Foot',
                'team_of_who_was_asked' => 'Jamal Foot',
                'created_at' => '2022-09-01 10:15:17',
                'updated_at' => '2022-09-01 10:15:17',
                'status' => 'pending',
            ),
            2 => 
            array (
                'id' => 21,
                'who_is_asking' => 'Paris@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '15H45',
                'place_of_game' => 'Lyon ',
                'team_of_asker' => 'Paris Basket',
                'team_of_who_was_asked' => 'Team-De-Basket',
                'created_at' => '2022-09-01 10:18:28',
                'updated_at' => '2022-09-23 10:58:44',
                'status' => 'refused',
            ),
            3 => 
            array (
                'id' => 22,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Paris@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '13H37',
                'place_of_game' => 'Caen',
                'team_of_asker' => 'Real Team',
                'team_of_who_was_asked' => 'Marseille Foot',
                'created_at' => '2022-09-16 07:35:00',
                'updated_at' => '2022-09-17 11:37:31',
                'status' => 'pending',
            ),
            4 => 
            array (
                'id' => 23,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '22H15',
                'place_of_game' => 'Lyon',
                'team_of_asker' => 'Team-De-Basket',
                'team_of_who_was_asked' => 'Jamal basket',
                'created_at' => '2022-09-16 12:58:02',
                'updated_at' => '2022-09-24 11:12:18',
                'status' => 'pending-score',
            ),
            5 => 
            array (
                'id' => 45,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '15H53',
                'place_of_game' => 'Paris',
                'team_of_asker' => 'Real Team',
                'team_of_who_was_asked' => 'Jamal Foot',
                'created_at' => '2022-09-24 13:53:55',
                'updated_at' => '2022-09-24 14:03:19',
                'status' => 'finish',
            ),
            6 => 
            array (
                'id' => 48,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '15H16',
                'place_of_game' => 'Lyon',
                'team_of_asker' => 'Jamal basket',
                'team_of_who_was_asked' => 'Team-De-Basket',
                'created_at' => '2022-09-29 13:17:12',
                'updated_at' => '2022-09-29 13:20:19',
                'status' => 'finish',
            ),
            7 => 
            array (
                'id' => 49,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '15H21',
                'place_of_game' => 'Paris stade',
                'team_of_asker' => 'Jamal basket',
                'team_of_who_was_asked' => 'Team-De-Basket',
                'created_at' => '2022-09-29 13:22:01',
                'updated_at' => '2022-09-29 13:23:15',
                'status' => 'finish',
            ),
            8 => 
            array (
                'id' => 50,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '15H25',
                'place_of_game' => 'Montpellier ',
                'team_of_asker' => 'Jamal basket',
                'team_of_who_was_asked' => 'Team-De-Basket',
                'created_at' => '2022-09-29 13:25:38',
                'updated_at' => '2022-09-29 13:40:55',
                'status' => 'finish',
            ),
            9 => 
            array (
                'id' => 51,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '15H45',
                'place_of_game' => 'Bordeaux ',
                'team_of_asker' => 'Real Team',
                'team_of_who_was_asked' => 'Jamal Foot',
                'created_at' => '2022-09-29 13:42:18',
                'updated_at' => '2022-09-29 13:44:11',
                'status' => 'finish',
            ),
            10 => 
            array (
                'id' => 52,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '15H30',
                'place_of_game' => 'Paris saint germain ',
                'team_of_asker' => 'Jamal Foot',
                'team_of_who_was_asked' => 'Real Team',
                'created_at' => '2022-09-30 09:07:46',
                'updated_at' => '2022-09-30 09:09:25',
                'status' => 'finish',
            ),
            11 => 
            array (
                'id' => 53,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '11H10',
                'place_of_game' => 'Man',
                'team_of_asker' => 'Jamal Foot',
                'team_of_who_was_asked' => 'Real Team',
                'created_at' => '2022-09-30 09:10:21',
                'updated_at' => '2022-09-30 09:12:05',
                'status' => 'finish',
            ),
            12 => 
            array (
                'id' => 54,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '11H39',
                'place_of_game' => 'Paris',
                'team_of_asker' => 'Team-De-Basket',
                'team_of_who_was_asked' => 'Jamal basket',
                'created_at' => '2022-09-30 09:39:27',
                'updated_at' => '2022-09-30 09:40:45',
                'status' => 'finish',
            ),
            13 => 
            array (
                'id' => 55,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '11H42',
                'place_of_game' => 'Caen',
                'team_of_asker' => 'Team-De-Basket',
                'team_of_who_was_asked' => 'Jamal basket',
                'created_at' => '2022-09-30 09:41:26',
                'updated_at' => '2022-09-30 09:42:43',
                'status' => 'finish',
            ),
            14 => 
            array (
                'id' => 56,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:27:49',
                'hours_of_game' => '21H41',
                'place_of_game' => 'Paris',
                'team_of_asker' => 'Jamal Foot',
                'team_of_who_was_asked' => 'Real Team',
                'created_at' => '2022-10-01 19:41:57',
                'updated_at' => '2022-10-01 19:43:37',
                'status' => 'finish',
            ),
            15 => 
            array (
                'id' => 57,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-10-06 18:28:04',
                'hours_of_game' => '21H45',
                'place_of_game' => 'Paris',
                'team_of_asker' => 'Jamal Foot',
                'team_of_who_was_asked' => 'Real Team',
                'created_at' => '2022-10-01 19:45:47',
                'updated_at' => '2022-10-01 19:45:47',
                'status' => 'pending',
            ),
            16 => 
            array (
                'id' => 101,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-04-15 02:20:58',
                'hours_of_game' => '19h30',
                'place_of_game' => 'New Guillermo',
                'team_of_asker' => 'Jamal Foot',
                'team_of_who_was_asked' => 'Real Team',
                'created_at' => '2022-10-06 08:34:50',
                'updated_at' => '2022-10-06 08:34:50',
                'status' => 'finish',
            ),
            17 => 
            array (
                'id' => 102,
                'who_is_asking' => 'Jamal@gmail.com',
                'who_was_asked' => 'jbull635@gmail.com',
                'date_of_game' => '2022-03-14 13:57:11',
                'hours_of_game' => '19h30',
                'place_of_game' => 'Erdmanville',
                'team_of_asker' => 'Jamal Foot',
                'team_of_who_was_asked' => 'Real Team',
                'created_at' => '2022-10-06 08:34:50',
                'updated_at' => '2022-10-06 08:34:50',
                'status' => 'finish',
            ),
            18 => 
            array (
                'id' => 103,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-05-27 06:02:49',
                'hours_of_game' => '19h30',
                'place_of_game' => 'South Carmine',
                'team_of_asker' => 'Real Team',
                'team_of_who_was_asked' => 'Jamal Foot',
                'created_at' => '2022-10-06 11:15:32',
                'updated_at' => '2022-10-06 11:15:32',
                'status' => 'finish',
            ),
            19 => 
            array (
                'id' => 104,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-07-07 10:06:35',
                'hours_of_game' => '19h30',
                'place_of_game' => 'South Jett',
                'team_of_asker' => 'Real Team',
                'team_of_who_was_asked' => 'Jamal Foot',
                'created_at' => '2022-10-06 11:15:32',
                'updated_at' => '2022-10-06 11:15:32',
                'status' => 'finish',
            ),
            20 => 
            array (
                'id' => 105,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-11-26 09:06:52',
                'hours_of_game' => '19h30',
                'place_of_game' => 'Homenickfurt',
                'team_of_asker' => 'Real Team',
                'team_of_who_was_asked' => 'Jamal Foot',
                'created_at' => '2022-10-06 11:23:47',
                'updated_at' => '2022-10-06 11:23:47',
                'status' => 'finish',
            ),
            21 => 
            array (
                'id' => 106,
                'who_is_asking' => 'jbull635@gmail.com',
                'who_was_asked' => 'Jamal@gmail.com',
                'date_of_game' => '2022-12-02 18:00:01',
                'hours_of_game' => '19h30',
                'place_of_game' => 'Enolamouth',
                'team_of_asker' => 'Real Team',
                'team_of_who_was_asked' => 'Jamal Foot',
                'created_at' => '2022-10-06 11:23:47',
                'updated_at' => '2022-10-06 11:23:47',
                'status' => 'finish',
            ),
        ));
        
        
    }
}