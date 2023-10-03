<?php

use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         *
         * Gametype: CSGO
         * Platform: Matchmaking
         * Type: By Rank
         *
         */
        $ranks = [
            [
                'rank' => 'Silver 1',
                'sequence' => 1,
                'price' => 6
            ],
            [
                'rank' => 'Silver 2',
                'sequence' => 2,
                'price' => 6
            ],
            [
                'rank' => 'Silver 3',
                'sequence' => 3,
                'price' => 6
            ],
            [
                'rank' => 'Silver 4',
                'sequence' => 4,
                'price' => 6
            ],
            [
                'rank' => 'Silver Elite',
                'sequence' => 5,
                'price' => 6
            ],
            [
                'rank' => 'Silver Elite Master',
                'sequence' => 6,
                'price' => 6
            ],
            [
                'rank' => 'Gold Nova 1',
                'sequence' => 7,
                'price' => 8
            ],
            [
                'rank' => 'Gold Nova 2',
                'sequence' => 8,
                'price' => 8
            ],
            [
                'rank' => 'Gold Nova 3',
                'sequence' => 9,
                'price' => 8
            ],
            [
                'rank' => 'Gold Nova Master',
                'sequence' => 10,
                'price' => 8
            ],
            [
                'rank' => 'Master Guardian 1',
                'sequence' => 11,
                'price' => 9.5
            ],
            [
                'rank' => 'Master Guardian 2',
                'sequence' => 12,
                'price' => 9.5
            ],
            [
                'rank' => 'Master Guardian Elite',
                'sequence' => 13,
                'price' => 15
            ],
            [
                'rank' => 'Distinguished Master Guardian',
                'sequence' => 14,
                'price' => 18
            ],
            [
                'rank' => 'Legendary Eagle',
                'sequence' => 15,
                'price' => 28
            ],
            [
                'rank' => 'Legendary Eagle Master',
                'sequence' => 16,
                'price' => 49
            ],
            [
                'rank' => 'Supreme Master First Class',
                'sequence' => 17,
                'price' => 89
            ],
            [
                'rank' => 'Global Elite',
                'sequence' => 18,
                'price' => 0,
                'final_rank' => 1
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'csgo',
                'platform' => 'matchmaking',
                'type' => 'rank',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: CSGO
         * Platform: Matchmaking
         * Type: By Wins
         *
         */
        $ranks = [
            [
                'rank' => 'Silver 1',
                'sequence' => 1,
                'price' => 2.4
            ],
            [
                'rank' => 'Silver 2',
                'sequence' => 2,
                'price' => 2.4
            ],
            [
                'rank' => 'Silver 3',
                'sequence' => 3,
                'price' => 2.4
            ],
            [
                'rank' => 'Silver 4',
                'sequence' => 4,
                'price' => 2.4
            ],
            [
                'rank' => 'Silver Elite',
                'sequence' => 5,
                'price' => 2.4
            ],
            [
                'rank' => 'Silver Elite Master',
                'sequence' => 6,
                'price' => 2.4
            ],
            [
                'rank' => 'Gold Nova 1',
                'sequence' => 7,
                'price' => 2.9
            ],
            [
                'rank' => 'Gold Nova 2',
                'sequence' => 8,
                'price' => 2.9
            ],
            [
                'rank' => 'Gold Nova 3',
                'sequence' => 9,
                'price' => 2.9
            ],
            [
                'rank' => 'Gold Nova Master',
                'sequence' => 10,
                'price' => 2.9
            ],
            [
                'rank' => 'Master Guardian 1',
                'sequence' => 11,
                'price' => 3.5
            ],
            [
                'rank' => 'Master Guardian 2',
                'sequence' => 12,
                'price' => 3.5
            ],
            [
                'rank' => 'Master Guardian Elite',
                'sequence' => 13,
                'price' => 4.5
            ],
            [
                'rank' => 'Distinguished Master Guardian',
                'sequence' => 14,
                'price' => 5
            ],
            [
                'rank' => 'Legendary Eagle',
                'sequence' => 15,
                'price' => 7
            ],
            [
                'rank' => 'Legendary Eagle Master',
                'sequence' => 16,
                'price' => 9
            ],
            [
                'rank' => 'Supreme Master First Class',
                'sequence' => 17,
                'price' => 14
            ],
            [
                'rank' => 'Global Elite',
                'sequence' => 18,
                'price' => 19,
                'final_rank' => 1
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'csgo',
                'platform' => 'matchmaking',
                'type' => 'win',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: CSGO
         * Platform: Faceit
         * Type: By Rank
         *
         */
        $ranks = [
            [
                'rank' => 'Level 1',
                'sequence' => 1,
                'price' => 15
            ],
            [
                'rank' => 'Level 2',
                'sequence' => 2,
                'price' => 15
            ],
            [
                'rank' => 'Level 3',
                'sequence' => 3,
                'price' => 17
            ],
            [
                'rank' => 'Level 4',
                'sequence' => 4,
                'price' => 21
            ],
            [
                'rank' => 'Level 5',
                'sequence' => 5,
                'price' => 22
            ],
            [
                'rank' => 'Level 6',
                'sequence' => 6,
                'price' => 25
            ],
            [
                'rank' => 'Level 7',
                'sequence' => 7,
                'price' => 29
            ],
            [
                'rank' => 'Level 8',
                'sequence' => 8,
                'price' => 49
            ],
            [
                'rank' => 'Level 9',
                'sequence' => 9,
                'price' => 89
            ],
            [
                'rank' => 'Level 10',
                'sequence' => 10,
                'price' => 0,
                'final_rank' => 1
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'csgo',
                'platform' => 'faceit',
                'type' => 'rank',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: CSGO
         * Platform: Faceit
         * Type: By Wins
         *
         */
        $ranks = [
            [
                'rank' => 'Level 1',
                'sequence' => 1,
                'price' => 4
            ],
            [
                'rank' => 'Level 2',
                'sequence' => 2,
                'price' => 4
            ],
            [
                'rank' => 'Level 3',
                'sequence' => 3,
                'price' => 4.5
            ],
            [
                'rank' => 'Level 4',
                'sequence' => 4,
                'price' => 5
            ],
            [
                'rank' => 'Level 5',
                'sequence' => 5,
                'price' => 5.5
            ],
            [
                'rank' => 'Level 6',
                'sequence' => 6,
                'price' => 7
            ],
            [
                'rank' => 'Level 7',
                'sequence' => 7,
                'price' => 9
            ],
            [
                'rank' => 'Level 8',
                'sequence' => 8,
                'price' => 14
            ],
            [
                'rank' => 'Level 9',
                'sequence' => 9,
                'price' => 17
            ],
            [
                'rank' => 'Level 10',
                'sequence' => 10,
                'price' => 19,
                'final_rank' => 1
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'csgo',
                'platform' => 'faceit',
                'type' => 'win',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: CSGO
         * Platform: ESEA
         * Type: By Rank
         *
         */
        $ranks = [
            [
                'rank' => 'D-',
                'sequence' => 1,
                'price' => 12
            ],
            [
                'rank' => 'D',
                'sequence' => 2,
                'price' => 12
            ],
            [
                'rank' => 'D+',
                'sequence' => 3,
                'price' => 12
            ],
            [
                'rank' => 'C-',
                'sequence' => 4,
                'price' => 13
            ],
            [
                'rank' => 'C',
                'sequence' => 5,
                'price' => 14
            ],
            [
                'rank' => 'C+',
                'sequence' => 6,
                'price' => 15
            ],
            [
                'rank' => 'B-',
                'sequence' => 7,
                'price' => 18
            ],
            [
                'rank' => 'B',
                'sequence' => 8,
                'price' => 25
            ],
            [
                'rank' => 'B+',
                'sequence' => 9,
                'price' => 35
            ],
            [
                'rank' => 'A-',
                'sequence' => 10,
                'price' => 49
            ],
            [
                'rank' => 'A',
                'sequence' => 11,
                'price' => 89
            ],
            [
                'rank' => 'A+',
                'sequence' => 12,
                'price' => 0,
                'final_rank' => 1
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'csgo',
                'platform' => 'esea',
                'type' => 'rank',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: CSGO
         * Platform: ESEA
         * Type: By Wins
         *
         */
        $ranks = [
            [
                'rank' => 'D-',
                'sequence' => 1,
                'price' => 3
            ],
            [
                'rank' => 'D',
                'sequence' => 2,
                'price' => 3
            ],
            [
                'rank' => 'D+',
                'sequence' => 3,
                'price' => 3.5
            ],
            [
                'rank' => 'C-',
                'sequence' => 4,
                'price' => 3.5
            ],
            [
                'rank' => 'C',
                'sequence' => 5,
                'price' => 4
            ],
            [
                'rank' => 'C+',
                'sequence' => 6,
                'price' => 4.5
            ],
            [
                'rank' => 'B-',
                'sequence' => 7,
                'price' => 4.5
            ],
            [
                'rank' => 'B',
                'sequence' => 8,
                'price' => 7
            ],
            [
                'rank' => 'B+',
                'sequence' => 9,
                'price' => 9
            ],
            [
                'rank' => 'A-',
                'sequence' => 10,
                'price' => 14
            ],
            [
                'rank' => 'A',
                'sequence' => 11,
                'price' => 17
            ],
            [
                'rank' => 'A+',
                'sequence' => 12,
                'price' => 19,
                'final_rank' => 1
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'csgo',
                'platform' => 'esea',
                'type' => 'win',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: Valorant
         * Platform: Matchmaking
         * Type: By Rank
         *
         */
        $ranks = [
            [
                'rank' => 'Iron I',
                'sequence' => 1,
                'price' => 10
            ],
            [
                'rank' => 'Iron II',
                'sequence' => 2,
                'price' => 10
            ],
            [
                'rank' => 'Iron III',
                'sequence' => 3,
                'price' => 10
            ],
            [
                'rank' => 'Bronze I',
                'sequence' => 4,
                'price' => 11
            ],
            [
                'rank' => 'Bronze II',
                'sequence' => 5,
                'price' => 11
            ],
            [
                'rank' => 'Bronze III',
                'sequence' => 6,
                'price' => 11
            ],
            [
                'rank' => 'Silver I',
                'sequence' => 7,
                'price' => 14.5
            ],
            [
                'rank' => 'Silver II',
                'sequence' => 8,
                'price' => 14.5
            ],
            [
                'rank' => 'Silver III',
                'sequence' => 9,
                'price' => 14.5
            ],
            [
                'rank' => 'Gold I',
                'sequence' => 10,
                'price' => 19
            ],
            [
                'rank' => 'Gold II',
                'sequence' => 11,
                'price' => 20
            ],
            [
                'rank' => 'Gold III',
                'sequence' => 12,
                'price' => 21
            ],
            [
                'rank' => 'Platinum I',
                'sequence' => 13,
                'price' => 28
            ],
            [
                'rank' => 'Platinum II',
                'sequence' => 14,
                'price' => 30
            ],
            [
                'rank' => 'Platinum III',
                'sequence' => 15,
                'price' => 33
            ],
            [
                'rank' => 'Diamond I',
                'sequence' => 16,
                'price' => 45
            ],
            [
                'rank' => 'Diamond II',
                'sequence' => 17,
                'price' => 49
            ],
            [
                'rank' => 'Diamond III',
                'sequence' => 18,
                'price' => 90
            ],
            [
                'rank' => 'Immortal I',
                'sequence' => 19,
                'price' => 130
            ],
            [
                'rank' => 'Immortal II',
                'sequence' => 20,
                'price' => 145
            ],
            [
                'rank' => 'Immortal III',
                'sequence' => 21,
                'price' => 180
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'valorant',
                'platform' => 'matchmaking',
                'type' => 'rank',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: Valorant
         * Platform: Matchmaking
         * Type: By Wins
         *
         */
        $ranks = [
            [
                'rank' => 'Iron I',
                'sequence' => 1,
                'price' => 4.5
            ],
            [
                'rank' => 'Iron II',
                'sequence' => 2,
                'price' => 4.5
            ],
            [
                'rank' => 'Iron III',
                'sequence' => 3,
                'price' => 4.5
            ],
            [
                'rank' => 'Bronze I',
                'sequence' => 4,
                'price' => 5.5
            ],
            [
                'rank' => 'Bronze II',
                'sequence' => 5,
                'price' => 5.5
            ],
            [
                'rank' => 'Bronze III',
                'sequence' => 6,
                'price' => 5.5
            ],
            [
                'rank' => 'Silver I',
                'sequence' => 7,
                'price' => 6.5
            ],
            [
                'rank' => 'Silver II',
                'sequence' => 8,
                'price' => 7
            ],
            [
                'rank' => 'Silver III',
                'sequence' => 9,
                'price' => 7.5
            ],
            [
                'rank' => 'Gold I',
                'sequence' => 10,
                'price' => 8.5
            ],
            [
                'rank' => 'Gold II',
                'sequence' => 11,
                'price' => 9
            ],
            [
                'rank' => 'Gold III',
                'sequence' => 12,
                'price' => 9.5
            ],
            [
                'rank' => 'Platinum I',
                'sequence' => 13,
                'price' => 10.5
            ],
            [
                'rank' => 'Platinum II',
                'sequence' => 14,
                'price' => 11.5
            ],
            [
                'rank' => 'Platinum III',
                'sequence' => 15,
                'price' => 14
            ],
            [
                'rank' => 'Diamond I',
                'sequence' => 16,
                'price' => 21
            ],
            [
                'rank' => 'Diamond II',
                'sequence' => 17,
                'price' => 25
            ],
            [
                'rank' => 'Diamond III',
                'sequence' => 18,
                'price' => 29
            ],
            [
                'rank' => 'Immortal I',
                'sequence' => 19,
                'price' => 35
            ],
            [
                'rank' => 'Immortal II',
                'sequence' => 20,
                'price' => 45
            ],
            [
                'rank' => 'Immortal III',
                'sequence' => 21,
                'price' => 55
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'valorant',
                'platform' => 'matchmaking',
                'type' => 'win',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: League of Legends
         * Platform: Matchmaking
         * Type: By Rank
         *
         */
        $ranks = [
            [
                'rank' => 'Iron IV',
                'sequence' => 1,
                'price' => 9
            ],
            [
                'rank' => 'Iron III',
                'sequence' => 2,
                'price' => 9
            ],
            [
                'rank' => 'Iron II',
                'sequence' => 3,
                'price' => 9
            ],
            [
                'rank' => 'Iron I',
                'sequence' => 4,
                'price' => 10
            ],
            [
                'rank' => 'Bronze IV',
                'sequence' => 5,
                'price' => 10
            ],
            [
                'rank' => 'Bronze III',
                'sequence' => 6,
                'price' => 10
            ],
            [
                'rank' => 'Bronze II',
                'sequence' => 7,
                'price' => 10
            ],
            [
                'rank' => 'Bronze I',
                'sequence' => 8,
                'price' => 15
            ],
            [
                'rank' => 'Silver IV',
                'sequence' => 9,
                'price' => 15
            ],
            [
                'rank' => 'Silver III',
                'sequence' => 10,
                'price' => 15
            ],
            [
                'rank' => 'Silver II',
                'sequence' => 11,
                'price' => 15
            ],
            [
                'rank' => 'Silver I',
                'sequence' => 12,
                'price' => 28
            ],
            [
                'rank' => 'Gold IV',
                'sequence' => 13,
                'price' => 28
            ],
            [
                'rank' => 'Gold III',
                'sequence' => 14,
                'price' => 28
            ],
            [
                'rank' => 'Gold II',
                'sequence' => 15,
                'price' => 28
            ],
            [
                'rank' => 'Gold I',
                'sequence' => 16,
                'price' => 38
            ],
            [
                'rank' => 'Platinum IV',
                'sequence' => 17,
                'price' => 38
            ],
            [
                'rank' => 'Platinum III',
                'sequence' => 18,
                'price' => 48
            ],
            [
                'rank' => 'Platinum II',
                'sequence' => 19,
                'price' => 48
            ],
            [
                'rank' => 'Platinum I',
                'sequence' => 20,
                'price' => 60
            ],
            [
                'rank' => 'Diamond IV',
                'sequence' => 21,
                'price' => 100
            ],
            [
                'rank' => 'Diamond III',
                'sequence' => 22,
                'price' => 150
            ],
            [
                'rank' => 'Diamond II',
                'sequence' => 23,
                'price' => 200
            ],
            [
                'rank' => 'Diamond I',
                'sequence' => 24,
                'price' => 240
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'lol',
                'platform' => 'matchmaking',
                'type' => 'rank',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }

        /**
         *
         * Gametype: League of Legends
         * Platform: Matchmaking
         * Type: By Wins
         *
         */
        $ranks = [
            [
                'rank' => 'Iron IV',
                'sequence' => 1,
                'price' => 2
            ],
            [
                'rank' => 'Iron III',
                'sequence' => 2,
                'price' => 2
            ],
            [
                'rank' => 'Iron II',
                'sequence' => 3,
                'price' => 2
            ],
            [
                'rank' => 'Iron I',
                'sequence' => 4,
                'price' => 2
            ],
            [
                'rank' => 'Bronze IV',
                'sequence' => 5,
                'price' => 2
            ],
            [
                'rank' => 'Bronze III',
                'sequence' => 6,
                'price' => 2
            ],
            [
                'rank' => 'Bronze II',
                'sequence' => 7,
                'price' => 2
            ],
            [
                'rank' => 'Bronze I',
                'sequence' => 8,
                'price' => 2
            ],
            [
                'rank' => 'Silver IV',
                'sequence' => 9,
                'price' => 3
            ],
            [
                'rank' => 'Silver III',
                'sequence' => 10,
                'price' => 3
            ],
            [
                'rank' => 'Silver II',
                'sequence' => 11,
                'price' => 4
            ],
            [
                'rank' => 'Silver I',
                'sequence' => 12,
                'price' => 4
            ],
            [
                'rank' => 'Gold IV',
                'sequence' => 13,
                'price' => 5
            ],
            [
                'rank' => 'Gold III',
                'sequence' => 14,
                'price' => 5
            ],
            [
                'rank' => 'Gold II',
                'sequence' => 15,
                'price' => 6
            ],
            [
                'rank' => 'Gold I',
                'sequence' => 16,
                'price' => 6
            ],
            [
                'rank' => 'Platinum IV',
                'sequence' => 17,
                'price' => 8
            ],
            [
                'rank' => 'Platinum III',
                'sequence' => 18,
                'price' => 8
            ],
            [
                'rank' => 'Platinum II',
                'sequence' => 19,
                'price' => 8
            ],
            [
                'rank' => 'Platinum I',
                'sequence' => 20,
                'price' => 10
            ],
            [
                'rank' => 'Diamond IV',
                'sequence' => 21,
                'price' => 12
            ],
            [
                'rank' => 'Diamond III',
                'sequence' => 22,
                'price' => 15
            ],
            [
                'rank' => 'Diamond II',
                'sequence' => 23,
                'price' => 23
            ],
            [
                'rank' => 'Diamond I',
                'sequence' => 24,
                'price' => 25
            ]
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert([
                'gametype' => 'lol',
                'platform' => 'matchmaking',
                'type' => 'win',
                'rank' => $rank['rank'],
                'sequence' => $rank['sequence'],
                'price' => $rank['price'],
                'final_rank' => isset($rank['final_rank'])
            ]);
        }
    }
}
