<?php

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
        // $this->call(UserSeeder::class);
        $this->call(ChampionTableSeeder::class);
        $this->call(BlogPostSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(HelpDeskFaqCategorySeeder::class);
        $this->call(HelpDeskFaqSeeder::class);
        $this->call(ElokingChatBotSeeder::class);
    }
}
