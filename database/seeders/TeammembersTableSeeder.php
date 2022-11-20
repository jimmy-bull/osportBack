<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TeammembersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('teammembers')->delete();
        
        \DB::table('teammembers')->insert(array (
            0 => 
            array (
                'id' => 64,
                'team_to_join' => 'Real Team',
                'who_want_to_join' => 'Paris@gmail.com',
                'team_to_join_owner' => 'jbull635@gmail.com',
                'status' => 'accepeted',
                'created_at' => '2022-09-01 04:58:11',
                'updated_at' => '2022-09-01 04:58:27',
                'notifications_id' => 394,
            ),
            1 => 
            array (
                'id' => 65,
                'team_to_join' => 'Real Team',
                'who_want_to_join' => 'Lille@gmail.com',
                'team_to_join_owner' => 'jbull635@gmail.com',
                'status' => 'accepeted',
                'created_at' => '2022-09-01 05:05:03',
                'updated_at' => '2022-09-01 05:05:09',
                'notifications_id' => 397,
            ),
            2 => 
            array (
                'id' => 72,
                'team_to_join' => 'Jamal Foot',
                'who_want_to_join' => 'rrunte@example.com',
                'team_to_join_owner' => 'Jamal@gmail.com',
                'status' => 'accepeted',
                'created_at' => '2022-09-01 05:46:43',
                'updated_at' => '2022-09-01 05:46:48',
                'notifications_id' => 405,
            ),
            3 => 
            array (
                'id' => 73,
                'team_to_join' => 'Jamal basket',
                'who_want_to_join' => 'rrunte@example.com',
                'team_to_join_owner' => 'Jamal@gmail.com',
                'status' => 'accepeted',
                'created_at' => '2022-09-01 05:47:52',
                'updated_at' => '2022-09-01 05:48:02',
                'notifications_id' => 407,
            ),
            4 => 
            array (
                'id' => 74,
                'team_to_join' => 'Jamal Foot',
                'who_want_to_join' => 'perry.stanton@example.org',
                'team_to_join_owner' => 'Jamal@gmail.com',
                'status' => 'accepeted',
                'created_at' => '2022-09-01 05:54:34',
                'updated_at' => '2022-09-01 05:54:42',
                'notifications_id' => 409,
            ),
            5 => 
            array (
                'id' => 75,
                'team_to_join' => 'Jamal basket',
                'who_want_to_join' => 'perry.stanton@example.org',
                'team_to_join_owner' => 'Jamal@gmail.com',
                'status' => 'accepeted',
                'created_at' => '2022-09-01 05:54:54',
                'updated_at' => '2022-09-01 05:55:05',
                'notifications_id' => 411,
            ),
            6 => 
            array (
                'id' => 76,
                'team_to_join' => 'Marseille Foot',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:35:46',
                'updated_at' => '2022-09-16 12:36:45',
                'notifications_id' => 421,
            ),
            7 => 
            array (
                'id' => 77,
                'team_to_join' => 'Marseille Foot',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:35:49',
                'updated_at' => '2022-09-16 12:36:43',
                'notifications_id' => 424,
            ),
            8 => 
            array (
                'id' => 78,
                'team_to_join' => 'Paris ckricket',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:35:50',
                'updated_at' => '2022-09-16 12:36:32',
                'notifications_id' => 425,
            ),
            9 => 
            array (
                'id' => 79,
                'team_to_join' => 'Marseille Foot',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:35:52',
                'updated_at' => '2022-09-16 12:36:26',
                'notifications_id' => 423,
            ),
            10 => 
            array (
                'id' => 80,
                'team_to_join' => 'Paris ckricket',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:35:54',
                'updated_at' => '2022-09-16 12:36:22',
                'notifications_id' => 426,
            ),
            11 => 
            array (
                'id' => 81,
                'team_to_join' => 'Paris ckricket',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:35:55',
                'updated_at' => '2022-09-16 12:36:21',
                'notifications_id' => 427,
            ),
            12 => 
            array (
                'id' => 82,
                'team_to_join' => 'Paris ckricket',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:35:57',
                'updated_at' => '2022-09-16 12:36:19',
                'notifications_id' => 428,
            ),
            13 => 
            array (
                'id' => 83,
                'team_to_join' => 'Paris ckricket',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:35:58',
                'updated_at' => '2022-09-16 12:36:13',
                'notifications_id' => 429,
            ),
            14 => 
            array (
                'id' => 84,
                'team_to_join' => 'Marseille Foot',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Paris@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:43:40',
                'updated_at' => '2022-09-16 12:46:27',
                'notifications_id' => 438,
            ),
            15 => 
            array (
                'id' => 85,
                'team_to_join' => 'Jamal Foot',
                'who_want_to_join' => 'jbull635@gmail.com',
                'team_to_join_owner' => 'Jamal@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-16 12:56:10',
                'updated_at' => '2022-09-16 12:56:41',
                'notifications_id' => 440,
            ),
            16 => 
            array (
                'id' => 86,
                'team_to_join' => 'Real Team',
                'who_want_to_join' => 'Jamal@gmail.com',
                'team_to_join_owner' => 'jbull635@gmail.com',
                'status' => 'declined',
                'created_at' => '2022-09-23 14:00:18',
                'updated_at' => '2022-09-23 14:00:24',
                'notifications_id' => 518,
            ),
            17 => 
            array (
                'id' => 87,
                'team_to_join' => 'Team-De-Basket',
                'who_want_to_join' => 'Jamal@gmail.com',
                'team_to_join_owner' => 'jbull635@gmail.com',
                'status' => 'accepeted',
                'created_at' => '2022-10-01 19:47:45',
                'updated_at' => '2022-10-01 19:53:37',
                'notifications_id' => 655,
            ),
        ));
        
        
    }
}