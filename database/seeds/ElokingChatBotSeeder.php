<?php

use App\User;
use Illuminate\Database\Seeder;

class ElokingChatBotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Eloking BOT',
            'email' => 'bot@eloking.com',
            'username' => 'eloking-bot',
            'active' => 1,
        ]);
    }
}
