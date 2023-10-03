<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HelpDeskFaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'Eloking',
            ],
            [
                'name' => 'League of Legends',
            ],
            [
                'name' => 'Valorant',
            ],
            [
                'name' => 'CS:GO',
            ],
        ];

        foreach ($data as $item) {
            $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table('help_desk_faq_categories')->insert($item);
        }
    }
}
