<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 5,
                'migration' => '2022_05_30_104918_add_more_field_to_users_table',
                'batch' => 2,
            ),
            2 => 
            array (
                'id' => 6,
                'migration' => '2022_05_31_110258_add_migration_for__post_table',
                'batch' => 3,
            ),
            3 => 
            array (
                'id' => 7,
                'migration' => '2022_05_31_110944_create_testusers_table',
                'batch' => 4,
            ),
            4 => 
            array (
                'id' => 8,
                'migration' => '2022_05_31_115218_create_myposts_table',
                'batch' => 5,
            ),
            5 => 
            array (
                'id' => 9,
                'migration' => '2022_05_31_133909_create_posts_table',
                'batch' => 6,
            ),
            6 => 
            array (
                'id' => 10,
                'migration' => '2022_06_23_165236_create_failed_jobs_table',
                'batch' => 0,
            ),
            7 => 
            array (
                'id' => 11,
                'migration' => '2022_06_23_165236_create_myposts_table',
                'batch' => 0,
            ),
            8 => 
            array (
                'id' => 12,
                'migration' => '2022_06_23_165236_create_password_resets_table',
                'batch' => 0,
            ),
            9 => 
            array (
                'id' => 13,
                'migration' => '2022_06_23_165236_create_personal_access_tokens_table',
                'batch' => 0,
            ),
            10 => 
            array (
                'id' => 14,
                'migration' => '2022_06_23_165236_create_Post_table',
                'batch' => 0,
            ),
            11 => 
            array (
                'id' => 15,
                'migration' => '2022_06_23_165236_create_posts_table',
                'batch' => 0,
            ),
            12 => 
            array (
                'id' => 16,
                'migration' => '2022_06_23_165236_create_testusers_table',
                'batch' => 0,
            ),
            13 => 
            array (
                'id' => 17,
                'migration' => '2022_06_23_165236_create_users_table',
                'batch' => 0,
            ),
            14 => 
            array (
                'id' => 102,
                'migration' => '0000_00_00_000000_create_websockets_statistics_entries_table',
                'batch' => 7,
            ),
            15 => 
            array (
                'id' => 103,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 7,
            ),
            16 => 
            array (
                'id' => 104,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => 7,
            ),
            17 => 
            array (
                'id' => 105,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
                'batch' => 7,
            ),
            18 => 
            array (
                'id' => 106,
                'migration' => '2022_03_22_101130_create_bid_data_table',
                'batch' => 7,
            ),
            19 => 
            array (
                'id' => 107,
                'migration' => '2022_03_25_185913_create_attrs_table',
                'batch' => 7,
            ),
            20 => 
            array (
                'id' => 108,
                'migration' => '2022_04_04_114047_create_favoris_table',
                'batch' => 7,
            ),
            21 => 
            array (
                'id' => 109,
                'migration' => '2022_04_10_180250_create_category_attributes_table',
                'batch' => 7,
            ),
            22 => 
            array (
                'id' => 110,
                'migration' => '2022_04_12_184156_create_attribute_ways_table',
                'batch' => 7,
            ),
            23 => 
            array (
                'id' => 111,
                'migration' => '2022_04_15_142335_create_estimations_table',
                'batch' => 7,
            ),
            24 => 
            array (
                'id' => 112,
                'migration' => '2022_04_18_065656_create_categories_table',
                'batch' => 7,
            ),
            25 => 
            array (
                'id' => 113,
                'migration' => '2022_04_18_071142_create_media_table',
                'batch' => 7,
            ),
            26 => 
            array (
                'id' => 114,
                'migration' => '2022_04_18_071531_create_details_table',
                'batch' => 7,
            ),
            27 => 
            array (
                'id' => 115,
                'migration' => '2022_04_18_071955_create_main_products_table',
                'batch' => 7,
            ),
            28 => 
            array (
                'id' => 116,
                'migration' => '2022_04_19_074023_add_user_email_to_main_products_table',
                'batch' => 7,
            ),
            29 => 
            array (
                'id' => 117,
                'migration' => '2022_04_21_141822_add_status_to_main_products_table',
                'batch' => 7,
            ),
            30 => 
            array (
                'id' => 118,
                'migration' => '2022_04_22_152624_create_auction_dates_table',
                'batch' => 7,
            ),
            31 => 
            array (
                'id' => 119,
                'migration' => '2022_04_22_220132_add_article_id_to_auction_dates',
                'batch' => 7,
            ),
            32 => 
            array (
                'id' => 120,
                'migration' => '2022_04_30_092920_create_bid_augmentations_table',
                'batch' => 7,
            ),
            33 => 
            array (
                'id' => 121,
                'migration' => '2022_05_12_135229_create_details_descs_table',
                'batch' => 7,
            ),
            34 => 
            array (
                'id' => 122,
                'migration' => '2022_05_25_083415_create_verifications_table',
                'batch' => 7,
            ),
            35 => 
            array (
                'id' => 123,
                'migration' => '2022_05_25_094142_change_verification_code_end_to_timestamp_in_verifications_table',
                'batch' => 7,
            ),
            36 => 
            array (
                'id' => 124,
                'migration' => '2022_05_25_094652_change_description_to_text_in_main_products_table',
                'batch' => 7,
            ),
            37 => 
            array (
                'id' => 125,
                'migration' => '2022_05_26_165916_change_verification_code_column_in_verifications_table',
                'batch' => 7,
            ),
            38 => 
            array (
                'id' => 126,
                'migration' => '2022_06_12_123239_create_user_status_products_table',
                'batch' => 7,
            ),
            39 => 
            array (
                'id' => 127,
                'migration' => '2022_06_16_082204_create_user_status_product_losts_table',
                'batch' => 7,
            ),
            40 => 
            array (
                'id' => 128,
                'migration' => '2022_06_16_083751_create_article_solds_table',
                'batch' => 7,
            ),
            41 => 
            array (
                'id' => 129,
                'migration' => '2022_06_16_084850_create_article_losts_table',
                'batch' => 7,
            ),
            42 => 
            array (
                'id' => 130,
                'migration' => '2022_06_26_124949_create_users__profile__photos_table',
                'batch' => 8,
            ),
            43 => 
            array (
                'id' => 131,
                'migration' => '2022_06_27_184707_create_teams_table',
                'batch' => 9,
            ),
            44 => 
            array (
                'id' => 132,
                'migration' => '2022_07_01_123857_add_more_column_to_users_table',
                'batch' => 10,
            ),
            45 => 
            array (
                'id' => 133,
                'migration' => '2022_07_08_133651_create_testing_tables_table',
                'batch' => 11,
            ),
            46 => 
            array (
                'id' => 134,
                'migration' => '2022_07_08_140502_create_bigs_table',
                'batch' => 12,
            ),
            47 => 
            array (
                'id' => 135,
                'migration' => '2022_07_21_103422_create_following_systems_table',
                'batch' => 13,
            ),
            48 => 
            array (
                'id' => 136,
                'migration' => '2022_07_21_110525_create_notifications_table',
                'batch' => 14,
            ),
            49 => 
            array (
                'id' => 137,
                'migration' => '2022_07_28_111225_create_notification_tokens_table',
                'batch' => 15,
            ),
            50 => 
            array (
                'id' => 138,
                'migration' => '2022_07_30_175635_add_notification_state',
                'batch' => 16,
            ),
            51 => 
            array (
                'id' => 139,
                'migration' => '2022_08_20_103545_add_wo_sent_notification_column',
                'batch' => 17,
            ),
            52 => 
            array (
                'id' => 140,
                'migration' => '2022_08_24_141913_create_ask_games_table',
                'batch' => 18,
            ),
            53 => 
            array (
                'id' => 141,
                'migration' => '2022_08_25_120607_create_teammembers_table',
                'batch' => 19,
            ),
            54 => 
            array (
                'id' => 142,
                'migration' => '2022_08_26_182221_add_foreign_key_to_teammembers_table',
                'batch' => 20,
            ),
            55 => 
            array (
                'id' => 143,
                'migration' => '2022_08_31_102838_add_status_to_ask_games_table',
                'batch' => 20,
            ),
            56 => 
            array (
                'id' => 144,
                'migration' => '2022_09_01_070313_create_defeats_table',
                'batch' => 21,
            ),
            57 => 
            array (
                'id' => 145,
                'migration' => '2022_09_01_070829_create_winnings_table',
                'batch' => 22,
            ),
            58 => 
            array (
                'id' => 146,
                'migration' => '2022_09_01_072355_create_draws_table',
                'batch' => 23,
            ),
            59 => 
            array (
                'id' => 147,
                'migration' => '2022_09_01_103445_add_score_2_column_to_winnings_table',
                'batch' => 24,
            ),
            60 => 
            array (
                'id' => 148,
                'migration' => '2022_09_03_103326_add_score_2_column_to_defeats_table',
                'batch' => 25,
            ),
            61 => 
            array (
                'id' => 149,
                'migration' => '2022_09_20_133631_create_team_rates_table',
                'batch' => 26,
            ),
            62 => 
            array (
                'id' => 150,
                'migration' => '2022_09_21_085257_add_status_column_to_team_rates_table',
                'batch' => 27,
            ),
            63 => 
            array (
                'id' => 151,
                'migration' => '2022_09_21_091153_add_teamrated_name_column_to_team_rates_table',
                'batch' => 28,
            ),
            64 => 
            array (
                'id' => 152,
                'migration' => '2022_09_21_092705_add_status_column_to_winning_table',
                'batch' => 29,
            ),
            65 => 
            array (
                'id' => 153,
                'migration' => '2022_09_21_092958_add_status_column_to_defeats_table',
                'batch' => 30,
            ),
            66 => 
            array (
                'id' => 154,
                'migration' => '2022_09_21_095147_add_status_column_to_draws_table',
                'batch' => 31,
            ),
            67 => 
            array (
                'id' => 155,
                'migration' => '2022_09_24_121247_add_game_id_column_to_team_rate_table',
                'batch' => 32,
            ),
            68 => 
            array (
                'id' => 156,
                'migration' => '2022_09_24_121520_add_foreign_game_id_column_to_team_rate_table',
                'batch' => 33,
            ),
            69 => 
            array (
                'id' => 157,
                'migration' => '2022_09_24_121850_add_foreign_game_id_2_column_to_team_rate_table',
                'batch' => 34,
            ),
            70 => 
            array (
                'id' => 158,
                'migration' => '2022_09_24_122019_add_foreign_game_id_3_column_to_team_rate_table',
                'batch' => 35,
            ),
            71 => 
            array (
                'id' => 159,
                'migration' => '2022_10_08_103849_create_post_tables_table',
                'batch' => 36,
            ),
            72 => 
            array (
                'id' => 160,
                'migration' => '2022_10_08_104611_create_image_video_tables_table',
                'batch' => 37,
            ),
            73 => 
            array (
                'id' => 161,
                'migration' => '2022_10_08_120425_create_comments_table',
                'batch' => 38,
            ),
            74 => 
            array (
                'id' => 162,
                'migration' => '2022_10_08_120815_change_post_tables_title_column_to_long_text_table',
                'batch' => 38,
            ),
            75 => 
            array (
                'id' => 163,
                'migration' => '2022_10_08_121522_create_likes_table',
                'batch' => 39,
            ),
        ));
        
        
    }
}