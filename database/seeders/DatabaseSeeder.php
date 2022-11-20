<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // // // \App\Models\User::factory(10)->create();
        // // $this->call(MainProductsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        // // $this->call(BidDataTableSeeder::class);
        // // $this->call(AttrsTableSeeder::class);
        $this->call(FavorisTableSeeder::class);
        // // $this->call(CategoryAttributesTableSeeder::class);
        // // $this->call(AttributeWaysTableSeeder::class);
        // // $this->call(EstimationsTableSeeder::class);
        // // $this->call(CategoriesTableSeeder::class);
        // // $this->call(MediaTableSeeder::class);
        // // $this->call(DetailsTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        // // $this->call(AuctionDatesTableSeeder::class);
        // // $this->call(BidAugmentationsTableSeeder::class);
        // // $this->call(DetailsDescsTableSeeder::class);
        // // $this->call(AddDefaultDataToMshopCatalog::class);
        $this->call(VerificationsTableSeeder::class);
        // $this->call(ArticleLostsTableSeeder::class);
        // $this->call(ArticleSoldsTableSeeder::class);
        $this->call(AskGamesTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(DefeatsTableSeeder::class);
        $this->call(DrawsTableSeeder::class);
        $this->call(FollowingSystemsTableSeeder::class);
        $this->call(ImageVideoTablesTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(MypostsTableSeeder::class);
        $this->call(NotificationTokensTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PostTablesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(TeammembersTableSeeder::class);
        $this->call(TeamRatesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(TestingTablesTableSeeder::class);
        $this->call(TestusersTableSeeder::class);
        $this->call(UsersProfilePhotosTableSeeder::class);
        $this->call(WebsocketsStatisticsEntriesTableSeeder::class);
        $this->call(WinningsTableSeeder::class);
    }
}
