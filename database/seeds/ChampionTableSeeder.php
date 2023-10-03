<?php

use Illuminate\Database\Seeder;

class ChampionTableSeeder extends Seeder
{
    protected $valorantCharactors = [
        'astra', 'Breach', 'Brimstone', 'Cypher', 'Jett', 'KAY/O', 'Killjoy',
        'Omen', 'Phoenix', 'Raze', 'Reyna', 'Sage', 'Skye', 'Sova', 'Viper', 'Yoru', 'Chamber',
    ];

    protected $lolCharactors = [
        'aatrox', 'ahri', 'akali', 'akshan', 'alistar', 'amumu', 'anivia', 'annie', 'aphelios', 'ashe',
        'aurelion sol', 'azir', 'bard', 'blitzcrank', 'brand', 'braum', 'caitlyn', 'camille', 'cassiopeia',
        "cho'Gath", 'corki', 'Darius', 'Diana', 'DR. Mundo', 'Draven', 'Ekko', 'Elise', 'evelynn', 'Ezreal',
        'Fiddlesticks', 'Fiora', 'Fizz', 'Galio', 'Gangplank', 'Garen', 'Gnar', 'Gragas', 'Graves', 'Gwen', 'Hecarim',
        'Heimerdinger', 'illaoi', 'Irelia', 'Ivern', 'Janna', 'Jarvan IV', "Jax", "Jayce", "Jhin", "Jinx",
        "Kaisa", "Kalista", "Karma", "Karthus", "Kassadin", "Katarina", "Kayle", "Kayn", "Kennen", "KhaZix",
        "Kindred", "Kled", "KogMaw", "LeBlanc", "Lee sin", "Leona", "Lillia", "Lissandra", "Lucian", "Lulu",
        "Lux", "Malphite", "Malzahar", "Maokai", "Master Yi", "Miss Fortune", "Mordekaiser", "Morgana", "Nami",
        "Nasus", "Nautilus", "Neeko", "Nidalee", "Nocturne", "Nunu & Willump", "Olaf", "Orianna", "Ornn",
        "Pantheon", "Poppy", "Pyke", "Qiyana", "Quinn", "Rakan", "Rammus", "RekSai", "Rell", "Renekton", "Rengar",
        "Riven", "Rumble", "Ryze", "Samira", "Sejuani", "Senna", "Seraphine", "Sett", "Shaco", "Shen", "Shyvana",
        "Singed", "Sion", "Sivir", "Skarner", "Sona", "Soraka", "Swain", "Sylas", "Syndra", "Tahm kench", "Taliyah",
        "Talon", "Taric", "Teemo", "Thresh", "Tristana", "Trundle", "Tryndamere", "Twisted Fate", "Twitch", "Udyr",
        "Urgot", "Varus", "Vayne", "Veigar", "VelKoz", "Vex", "Vi", "Viego", "Viktor", "Vladimir", "Volibear", "Warwick",
        "Wukong", "Xayah", "Xerath", "Xin Zhao", "Yasuo", "Yone", "Yorick", "Yuumi", "Zac", "Zed", "Ziggs", "Zilean", "Zoe", "Zyra"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createChampion($this->valorantCharactors, 'valorant');
        $this->createChampion($this->lolCharactors, 'lol');
    }

    protected function createChampion($names, $gametype)
    {
        foreach ($names as $name) {
            if (! \App\Champion::whereName($name)->where('gametype', $gametype)->exists()) {
                \App\Champion::create([
                    'name' => $name,
                    'gametype' => $gametype
                ]);
            }
        }
    }
}
