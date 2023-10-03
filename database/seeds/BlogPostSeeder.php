<?php

use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Add blog posts in database
     *
     * @return void
     */
    public function run()
    {
        $content = <<<HERE
        <p>Are you tired of being in silver and would like to finally get out of this rank? Then perhaps this guide will be
        useful for you. First of all, I want to assure you that getting out of silver is easy if you follow this guide.</p>
        <h2>Don't Solo Queue</h2>
        <p>Let's begin with the most important thing, which is avoiding solo queue. You don't want to randomly
        queue up with possibly people who don't want to win or maybe just playing to waste time, as CS:GO is a
        team game you will definitely need people who can communicate, play together and achieve the same
        desired target you all want. Even in football Ronaldo and Messi won't be as shiny as they are without
        their teammates. So you got to find a group of friends to play with and avoid clicking the "Search" button
        without your premade.</p>
        <h2>Communication</h2>
        <p>The key of winning games in every competitive game is communication. Calling stuff and communicating
        means that you and your team are not lost in the map you are playing and you know what you're exactly
        doing, so you should call everything you see and hear, like footsteps or even utility being used by the
        opponents. So always try to step up your communication and make sure your team is also doing so.</p>
        <h2>Teamplay</h2>
        <p>CS:GO is a team game so you should play with your team, you don't want everyone
        to be split in the map so if we combine communication with teamplay what we get is strategies. So make
        sure that every round in the game someone has to call a strategy that everyone has to follow.</p>
        <h2>Low Mouse Sensitivity</h2>
        <p>You should use as low mouse sensitivity as possible, make sure that it's comfortable for you to move the
        crosshair, and in surprise case scenarios you could turn 180 degrees with this sensitivity in case
        someone is behind you. But let your sensitivity be as low as possible as it helps with aiming better.</p>
        <h2>Crosshair Placement</h2>
        <p>At silver rank everyone aims at leg level, which is a big disadvantage when you have to fight someone,
        so the main tip here is to always keep your crosshair at head height so you get better chances to hit
        your headshots. It might feel worse in the beginning but soon enough you will start hitting those heads.</p>
        <h2>Control Your Fire</h2>
        <p>You should always try not to panic when you see your opponent, I saw a lot of people in silver rank
        immediately spray when they see the enemy. That's wrong, you should try to tap or even burst fire if your
        enemy is fighting from long distance, but if you are fighting from a short distance then spraying should be
        okay there.</p>
        <h2>Movement</h2>
        <p>In order to hit your shots and be a hard target to hit yourself, it all starts with the movement, so for
        CS:GO you need to stand still to have perfect accuracy with your weapon, you can't just run and gun like
        some other games, but if you're just standing there you'll be an easy target to hit, so you'll need to strafe,
        stop then shoot.</p>
        <p>Let's hope this guide was useful enough for you and don't forget to check out our services as they make
        your gaming experience easier.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'How to get out of Silver rank in CS:GO',
            'slug' => 'how-to-get-out-of-silver-rank-in-csgo',
            'content' => $content,
            'category' => 'csgo',
            'image' => \URL::to('/img/blog/images/csgo-1.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <h2>What are launch options in CS:GO?</h2>
        <p>Launch options are the technical settings your game starts with, such as max FPS and tick rate for offline
        matches. You only need to enter them one time and it will be applied every time you launch the game.</p>
        <p>To set your launch options you need to:</p>
        <ol>
            <li>Open steam library</li>
            <li>Right click CS:GO and choose properties</li>
            <li>Go to General and you'll find Launch Options down below</li>
            <li>Enter the desired commands and they will be saved automatically</li>
        </ol>
        <h2>All available Launch Options in CS:GO</h2>
        <p>
        <strong>-full/-fullscreen</strong> - the game will launch in fullscreen mode<br />
        <strong>-window/-windowed</strong> - CS:GO launches in a standard window<br />
        <strong>-noborder</strong> - the game window has no borders<br />
        <strong>+r_dynamic [0/1]</strong> - this command helps you disable (0) and enable (1) dynamic lighting<br />
        <strong>-x</strong> - the position of the CS:GO window on the screen (horizontally)<br />
        <strong>-y</strong> - the position of the CS:GO window on the screen (horizontally)<br />
        <strong>-w/width</strong> - with this commands you can set the window width (resolution)<br />
        <strong>-h/height</strong> - with this commands you can set the window height (resolution)<br />
        <strong>-tickrate</strong> - a tick rate for your offline server and matches with bots. The default value here is 64. Increase
        it to get the game information refreshed more often. Bigger tick rates might overload your computer<br />
        <strong>+fps max 0</strong> - play with no limitations on the maximal CS:GO FPS. Use your value to set this limitation,
        for example, +fps max 60 (or even less to have CS:GO FPS boost on outdated computers);<br />
        <strong>+cl_showfps 1</strong> - to show FPS CS:GO<br />
        <strong>-high</strong> - CS:GO gets the highest priority from the computer<br />
        <strong>-novid</strong> - the game launches without the short starting video<br />
        <strong>-nojoy</strong> - to disable joysticks. This slightly decreases the load on the computer<br />
        <strong>-console</strong> - the CS:GO developer console will be open after the game launch<br />
        <strong>-language [English]</strong> - to activate the English interface of CS:GO. You can use another language as well<br />
        <strong>-refresh</strong> - this command selects how many times the pixels on the monitor will be refreshed per second<br />
        <strong>-threads</strong> - enter here the number of CPU’s cores. Use the command if your CPU has three or more
        cores (it’s how to make CS:GO faster via a single action). It might have no influence because the game
        often makes the same on its own<br />
        <strong>+r_drawparticles 0</strong> - remove particles animation, so the picture will become simpler, but the
        performance might improve<br />
        <strong>+cl_forcepreload 1</strong> - computer loads virtual model and textures before the match, decreasing the load
        during the game<br />
        <strong>-nod3d9ex1</strong> - to disable the technology Direct3D 9Ex. Try to experiment with this command to see its
        real effect on the performance of your computer<br />
        <strong>-lv</strong> - the command removes blood and thus reduces the load on your computer<br />
        <strong>-autoconfig</strong> - use this command to clear up all the custom settings and return to default
        </p>
        <h2>Best Launch Options to use</h2>
        <p>Most professional players use the following:</p>
        <p>-console -novid -freq 240 -tickrate 128 +exec config.cfg</p>
        <h3>Commands Explanation</h3>
        <p>
        <strong>-console</strong> - the CS:GO developer console will be open after the game launch<br />
        <strong>-novid</strong> - the game launches without the short starting video<br />
        <strong>-freq 240</strong> - customization of play frequency for CSGO. The possible values are: 60, 75, 120, 144, 165,
        240, 265, 285, 360.<br />
        <strong>-tickrate 128</strong> - tickrate setting for your client will be working for your offline servers and game with bots.<br />
        <strong>+exec config.cfg</strong> - loads a custom config file<br />
        </p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'Best CS:GO Launch Option Settings 2021',
            'slug' => 'best-csgo-launch-option-settings-2021',
            'content' => $content,
            'category' => 'csgo',
            'image' => \URL::to('/img/blog/images/csgo-2.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>With recent game update, developers have added a new voice command you can use to make
        your game even more fun, this command is the MOAN command? Yes you've read it right, now
        you can moan in CS:GO if you follow the steps below:</p>
        <ol>
            <li>Open the console: (if you don't have it on, go to Options > find Enable Developer Console
        and turn it on by changing the option to "Yes") - The default key binding for the console is the
        tilde key (~).</li>
            <li>Write in the console (bind -your button- "playerradio deathcry Moan"). For example "bind z "playerradio
            deathcry Moan".</li>
            <li>Press the specified key (in our example, key z) to moan.</li>
        </ol>
        <p>Here is a video tutorial for it:
            <a href="https://www.youtube.com/watch?v=xfmmWu-n9Qc" rel="nofollow noreferrer" target="_blank">YouTube:
            How to moan in CS:GO</a>
        </p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'CS:GO Moan Command: How to moan in CS:GO',
            'slug' => 'how-to-moan-in-csgo',
            'content' => $content,
            'category' => 'csgo',
            'image' => \URL::to('/img/blog/images/csgo-3.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>Have you ever wondered how the game has fancy and very strong colors in some streams? It is no
        secret that such settings can make a huge positive difference on your performance since it gives you
        better visibility and feeling.</p>
        <p>With this guide we are going to show you the best NVIDIA settings that makes your game look smoother
        and better, and possibly make you gain some more FPS.</p>
        <p>This guide will be separated to two sections, the first section will show you how can you get the best
        visibility possible from NVIDIA settings and the second section will show you how you can get the best
        FPS possible by just changing some settings in the NVIDIA Control Panel.</p>
        <h2>The best NVIDIA settings for visibility in CS:GO</h2>
        <p>There are some visibility issues with CS:GO and sadly, the in-game settings are not enough to change
        them but luckily NVIDIA Control Panel makes you able to change that.</p>
        <ol>
        <li>Launch the NVIDIA Control Panel</li>
        <li>Click the "Adjust Desktop Color Settings" in the Display section</li>
        <li>Proceed to follow the image below:<br />
        <img src="/img/blog/content/nvidia-colors.png" alt="NVIDIA Video Settings for CS:GO" /></li>
        <li>Click Apply.</li>
        </ol>
        <h2>The best NVIDIA settings for FPS boost</h2>
        <p>It is not a secret that with these settings you can get noticeable positive changes in your frame rates. With
        this guide we are going to show you how to tweak, optimize and speed up your NVIDIA Control for
        CS:GO to have smoother gameplay. This guide works amazingly well on both old and brand new
        PCs, it ensures you are getting the MOST out of your NVIDIA GeForce graphics card by optimizing it
        properly.</p>
        <ol>
        <li>Launch the NVIDIA Control Panel</li>
        <li>Go to Adjust image settings with preview: Select the option "Use the Advanced 3D Settings" then click "Take me there"</li>
        <li>Now you want to go to Program Settings and select CS:GO</li>
        <li>Proceed to follow the images below:<br />
        <img src="/img/blog/content/nvidia-fps1.png" alt="NVIDIA Video Settings for FPS Boost 1" /><br />
        <img src="/img/blog/content/nvidia-fps2.png" alt="NVIDIA Video Settings for FPS Boost 2" /><br />
        <img src="/img/blog/content/nvidia-fps3.png" alt="NVIDIA Video Settings for FPS Boost 3" /></li>
        <li>Click Apply.</li>
        </ol>
        <p>On top of the NVIDIA settings, a lot more can be achieved when combined with In-Game settings. We
        have another post covering the <a href="/blog/best-video-settings-for-csgo" class="fancy">Best In-Game Video
        Settings for CS:GO</a>.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'Best NVIDIA Settings for CS:GO',
            'slug' => 'best-nvidia-settings-for-csgo',
            'content' => $content,
            'category' => 'csgo',
            'image' => \URL::to('/img/blog/images/csgo-4.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <h2>Video Settings</h2>
        <p>Playing CS:GO with the best video settings can definitely make huge difference in your performance.</p>
        <p>If you find it hard to see your opponents then it won't be easy to win the fire fights against them. Luckily
        for you, there are some settings you can play with to improve the visibility.</p>
        <p>In this guide, we are going to show you how to finally get over the video settings problem and get you the
        best video settings you can find up to date.</p>
        <p>The first thing we are going to show you is the "Video" tab. The 130% Brightness gives you a huge
        advantage to see your enemies if they are playing behind a molotov or even standing in a dark spot. The
        Resolution 1280x960, is the most played Resolution by CS:GO Pros, basically this resolution makes the
        characters wider, so with this resolution hitting shots should be easier.</p>
        <img src="/img/blog/content/csgo-ingame-video.png" alt="CS:GO Video Settings" />
        <p>Then we move to the "Advanced Video Settings" - We recommend leaving this as we show you in the
        image below to secure the best experience you can get.</p>
        <img src="/img/blog/content/csgo-ingame-video2.png" alt="CS:GO Video Settings 2" />
        <img src="/img/blog/content/csgo-ingame-video3.png" alt="CS:GO Video Settings 3" />
        <p>We can guarantee you with these settings you'll get the best gaming experience possible if you follow it
        properly.</p>
        <h2>How to see through Molotovs</h2>
        <p>Since molotov grenades are one of the most used utilities in Counter Strike, seeing through the molotov is a
        big advantage for every individual. To achieve that, you must follow the settings we have provided. Here is
        the difference of a molotov in high settings and in low settings.</p>
        <img src="/img/blog/content/csgo-see-through-molotov.png" alt="CS:GO See through molotov" />
        <h2>Boost Player Contrast</h2>
        <p>We must say that a lot of players turn off the "Boost Player Contrast" setting, this is quite wrong because
        this setting increases the character’s contrast against the background at far distances, strengthens edge pixels for
        characters at far distances, creates a small blur around a character to reduce background
        noise and finally creates a small contrasting halo around a character when there is no color difference
        between the character and the environment so turning it off will make you lose all these advantages, so
        make sure to it always keep it on.</p>
        <img src="/img/blog/content/csgo-boost-player-contrast-off.png" alt="CS:GO Boost player contrast off" />
        <img src="/img/blog/content/csgo-boost-player-contrast-on.png" alt="CS:GO Boost player contrast on" />
        <h2>Stretched vs Native resolution</h2>
        <p>The stretched vs Native argument has always been famous in Counter-Strike, to know which aspect ratio
        is better for you, you have to open your eyes about some points and ask yourself which one offers the
        best visibility? 16:9 or 4:3 Stretched? Even though that's a difficult question to answer let us make it
        easier for you, each one of them has their up and down sides so it's hard to make one side a winner.</p>
        <p>16:9 has a massive perk and makes you be able to see more of the size of your screen meaning that you
        will be able to spot players that you otherwise wouldn't, even though that's an advantage, 4:3 also offers
        a big advantage which is that you can see your opponents bigger and wider especially at longer ranges.</p>
        <p>16:9 has a lot more pixels to render than 4:3, fewer pixels means less graphical performance needed to
        render frames and therefore higher FPS, that means that 4:3 will be able to give you more FPS than 16:9
        but that will make your game more snappy.</p>
        <p>Here how characters would like in both aspect ratios:</p>
        <img src="/img/blog/content/csgo-resolution-compare.png" alt="CS:GO Resolution comparison" />
        <p>With that being said we must say that FPS is super important, the more frames you have, the better.
        More FPS equals smoothest animations and low latency. CS:GO is a processor based game so if you're
        looking to upgrade your hard ware, you should aim at the processor.</p>
        <h2>Vibrance</h2>
        <p>In some streams, you may notice that the game is very vibrant, that's because of the NVIDIA Control
        Panel vibrance settings, make sure to check out our topic about it:
        <a href="/blog/best-nvidia-settings-for-csgo" class="fancy">Best NVIDIA Settings for CS:GO</a>.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'Best In-Game Video Settings for CS:GO',
            'slug' => 'best-video-settings-for-csgo',
            'content' => $content,
            'category' => 'csgo',
            'image' => \URL::to('/img/blog/images/csgo-5.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>It's nearly impossible to tell when you are going to rank up in CS:GO. Despite that, there's some factors
        that could help you rank up faster. Ranking up in CS:GO depends on the ELO system, which means that
        you play versus players with close ELO to yours, and when you win, you take certain amount of elo,
        same as when you lose, you lose some ELO. We have asked our professional boosters about factors
        that could help you rank up faster and we have got a reliable answer, so follow up below with those
        factors.</p>
        <h2>Consistency</h2>
        <p>Having a consistent high performance will definitely help you rank up faster, if you're always top fragging
        and making crucial plays, you're most likely expected to gain more ELO. Even if you lose, but you're
        performing well, you won't lose that much ELO that you would if you were under performing, so to have a
        consistent performance you got to have a warm-up routine before going on ranked games so make sure
        to do that as well.</p>
        <h2>MVP Stars</h2>
        <p>According to a research of ours, having MVPs is just as important as being a top fragger in regards to
        ranking up. You can get MVPs by planting the bomb, having most eliminations in a single round or even
        defusing the bomb. If you are compared to someone who has 1-2 MVPs when you have like 8-9 MVPs
        then you're the favored one to rank up in this case.</p>
        <h2>Queue Up With Higher Ranks</h2>
        <p>Let's say that you're DMG and you're queuing up with a Supreme and you go against other Supreme
        players, the chances of you ranking up if you win that game is higher than when you queue up with lower
        ranks or even your exact same rank. So if you have higher rank friends, go ahead and queue up with
        them so you could rank up faster</p>
        <h2>Win Most Rounds</h2>
        <p>Every single round you win is a victory for your rating, winning a game 16-0 will definitely get you more
        ELO points than winning a game 16-14, so you should consider winning every single round if you want to
        make your chances higher to rank up.</p>
        <h2>Have A Good Trust Factor</h2>
        <p>Having a Yellow or Red trust factor is definitely not better than having a Green one, we have noticed that
        players with Green trust factor are most likely to rank up faster than players with Yellow/Red ones, so
        don't do stuff that would affect your trust factor, e.g. Griefing.</p>
        <h2>Buy boosting</h2>
        <p>Boosting Service is a great choice if you want to sit back and enjoy our professionals do
        the work for you. We understand that you could meet trolls, smurfs or you don't have the time to get a
        higher rank, that's why at Eloking we provide you with highest quality boost you could find online, while
        most boosting sites are operated by individuals, Eloking is an official company.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'How To Rank Up Faster In CS:GO',
            'slug' => 'how-to-rank-up-faster-in-csgo',
            'content' => $content,
            'category' => 'csgo',
            'image' => \URL::to('/img/blog/images/csgo-1.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <h2>How do the Ranks work in CS:GO:</h2>
        <p>Like any other competitive game CS:GO also got a ranking system, a very unique one we could tell.
        CS:GO's ranking system is certainly one of the most unpredictable systems you could find in a
        competitive video game. It is very hard to tell when are you going to rank up or when are you going to
        rank down since there are no visible ELO points you can see, such as games as Valorant.</p>
        <h2>What are the CS:GO Ranks</h2>
        <p>There are currently 18 ranks. The ranks from upper left to right are: Silver 1, Silver 2, Silver 3, Silver 4,
        Silver Elite, Silver Elite Master, Gold Nova 1, Gold Nova 2, Gold Nova 3, Gold Nova Master, Master
        Guardian 1, Master Guardian 2, Master Guardian Elite, Distinguished Master Guardian, Legendary
        Eagle, Legendary Eagle Master, Supreme Master First Class, and The Global Elite.</p>
        <h2>Rank Descriptions</h2>
        <h3>Silver 1 to Silver Elite Master</h3>
        <p>Silver without a doubt is the easiest skill group in the entire game. The ranked games you should find in
        Silver are non-competitive and it will be hard to find anyone that is actually trying to win the game, so
        getting out of Silver shouldn't be that hard, it only requires you a little bit of aim and that should be it, if
        you have a below-average aim then you should be able to carry most of your games.</p>
        <h3>Gold Nova 1 to Gold Nova Master</h3>
        <p>Congratulations if you have got out of Silver, now that you're in Nova, you will probably need to improve
        your aim to better, so I highly recommend you to have an aim practice routine, such as playing Aimlab or
        going into Aim_botz map for a certain amount of time daily, so that you'll get to have a better aim, then
        going out of Nova shouldn't be that hard for you, since Silver and Nova ranks are all about killing your
        opponents and you won't find that much of people who got a good game sense.</p>
        <h3>Master Guardian 1 to Master Guardian Elite</h3>
        <p>In those three ranks, you'll find players who actually try to win games. Theoretically, players in those
        ranks have got a decent aim and a decent game knowledge so getting out of Master Guardian won't be
        as easy as Silver and Gold Nova were, now what you need to work on, is your experience, try to play as
        many games as you could so that your game knowledge and experience proceed to improve. You'll also
        need to improve your movement as movement is very important in CS:GO and it is actually a hard thing
        to learn but it will come with time.</p>
        <h3>Distinguished Master Guardian to Legendary Eagle Master</h3>
        <p>Now you will find players who sweat and try so hard to win games, but they are still lacking some factors
        such as good communication, team play, good decision making, and mentality control. The players who
        work on those factors and try to master them will definitely get out of those ranks.</p>
        <h3>Supreme Master First Class and The Global Elite</h3>
        <p>If you have reached those ranks, then congratulation you're in the highest CS:GO in-game ranks, you
        can just work on yourself and improve yourself to the best and if you feel like the game became too easy
        for you, then it's time to go on other platforms such as FACEIT, ESEA or even Esportal and get the game
        to become even more competitive for you.</p>
        <h2>What rank is s1mple in CS:GO?</h2>
        <p>s1mple has currently more than 4000 ELO in FACEIT (which is better than The Global Elite) and he won the
        PGL Major Championship, not to forget that he was ranked the best player of 2018 and 2021 in the esports scene.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'CS:GO Ranks in 2022',
            'slug' => 'csgo-ranks-in-2022',
            'content' => $content,
            'category' => 'csgo',
            'image' => \URL::to('/img/blog/images/csgo-2.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>With this guide I'm going to show you how can you escape elo hell? First we need
        to explain what is elo hell. Elo hell is when you are playing in lower ranks with most likely poor
        quality games and often determined by factors that is out of your control, such as bad team
        mates. In order to climb out of elo hell, we have had a discussion with our Radiant players and
        asked them how can a player get out of such ranks as Iron, Bronze and Silver. We have collected
        the main points that could get you out of elo hell, so make sure to follow this guide and you will
        achieve good results!</p>
        <h2>Coordination</h2>
        <p>Let me tell you this, a team with a little bit of coordination in these ranks is most likely going to get more
        rounds, and as you might know, coordination is a little bit hard in Elo Hell so if you could, try to play with
        premades so that you'll be more coordinated than going solo. Try to always call stuff to do and not let
        everyone play on his own on the map, always call strategies to do and everyone should follow them. So
        if you work on that with your team mates you're most likely going to win most of your games.</p>
        <h2>Being a Team Player</h2>
        <p>Sometimes it's not all about being the top fragger - getting an entry for your team is way more better than
        getting 3 kills when all your team mates are dead. So always try to be impactful, if you're playing a
        flasher then flash for your team mates, if you're a smoker than smoke for your team mates, always make
        sure to go first as duelist and never bait and try to get impactful kills that could actually secure you some
        rounds.</p>
        <h2>Stop Blaming</h2>
        <p>Yes, blaming your team mates gets you and your whole team, since you could lead up a fight that will
        grow through the whole games and make you lose a lot of rounds. If you're stuck in Elo Hell then no
        wonder you'll have games with not so good players, so instead of blaming them try to motivate them by
        saying "Nice try" or "It's all good" and focus on the next round. Trust me, doing this will make you win lots
        of games, so always try to be positive and it's going to pay off.</p>
        <h2>Aim and Mechanical Practice</h2>
        <p>In order to be more consistent and be able to carry most of your games then you will have to practice
        your aim everyday and actually improve. So always set 15-20 minute everyday on Aimlab or Deathmatch
        before hopping on ranked games.</p>
        <h2>Don't be afraid to lose games</h2>
        <p>Some players take the game way too seriously and it doesn't affect positively, It's a game you're trying to
        have fun (and win of course) but just take it easy and play to the best of your ability. It'll make you
        improve!</p>
        <h2>Buy Elo Boost</h2>
        <p>If nothing is working and you're way too frustrated then it's time to let a professional gets you the work
        done while you rest your back. Eloking offers you Radiant players to get you the desired rank you want
        for cheap, so if you ever needed a helping hand Eloking is your choice. You can also get coaching during the
        process.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'How to get out of ELO hell in Valorant',
            'slug' => 'how-to-get-out-of-elo-hell-in-valorant',
            'content' => $content,
            'category' => 'valorant',
            'image' => \URL::to('/img/blog/images/valorant-1.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <h2>Crosshair Placement</h2>
        <p>A lot of players tend to keep their aim at the ground and that is a very bad habit that you should avoid
        doing. Try to always keep your aim at head level because if you have it at the ground while facing an
        opponent then you'll take a little bit of time to move your crosshair at the proper body or head level. But if
        you already have your aim at head level then you get the advantage of reacting faster with your mouse.</p>
        <h2>Preaiming</h2>
        <p>You should always preaim at the angles you want to peek before peeking them. What does that mean? If
        you're expecting your opponent to be standing on a specific position then you should aim at that position
        before even peeking that position and that gives you the advantage to react faster on your opponent and
        possibly get the kill on him.</p>
        <h2>Use Your Abilities</h2>
        <p>Ability usage in Valorant is a very big plus and truly is game-changing, whether you're supporting your
        team or even using abilities to entries or even playing line ups in a post-plant. So you should always try
        and not only depend on your aim but also on your abilities, for example, try to flash for yourself when
        you're playing an agent that has a flash, you could also do a one way smoke and play on it. Placing a
        sage wall and staying on the top of it as an off-angle is also very unexpected, there is a lot do with
        abilities, always try to be creative with it.</p>
        <h2>Counter Strafing</h2>
        <p>This is a very popular and important tip that lots of players in lower levels don't follow. Most of them
        peek with just A or D - that is wrong because you don't get full accuracy for a few seconds. Instead, you
        should always counter strafe - A then cut the strafe by pressing D then shoot and vice versa, that way you'll have full
        accuracy after you strafe. Counter Strafing may sound easy but you should master it by practicing first.</p>
        <h2>Plant The Spike</h2>
        <p>Yes, always plant the spikes even if you already have won the round, your team gets money and you get
        an orb point when you plant the spike, this could be big at crucial and close games so don't miss this
        one.</p>
        <h2>Economy Management</h2>
        <p>In order to win games you will always have to work on your economy and manage it properly, and since
        Valorant is a team game then the whole team should work this together. For example: if you lost a round
        and don't have enough money to buy rifles then someone in the team should call to go for an Eco
        Round, an Eco Round is when the whole team save their money in order to have a proper buy on the
        next round.</p>
        <h2>Stop Crouching</h2>
        <p>Crouching is a very bad habit that lots of players tend to do. Crouching makes you a really easy target to
        kill so you should avoid doing it. You should crouch when you're fighting from a really far angle and you
        need that first bullet accuracy.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'How to improve aim in Valorant',
            'slug' => 'how-to-improve-aim-in-valorant',
            'content' => $content,
            'category' => 'valorant',
            'image' => \URL::to('/img/blog/images/valorant-2.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>Do you feel like you're spending too much time in Valorant Ranked and you're not getting better or even
        climbing ranks? Then you're doing it wrong. Valorant is an FPS game, that's true, but it's not only about
        having a god-like aim, there are many things you will need to work on so you could improve in Valorant and
        actually climb the ranks and reach the top. Within this topic we are going to share tips and tricks to make you
        actually improve in Valorant.</p>
        <h2>Maintain Your Mentality</h2>
        <p>Yes, mentality is the one of the biggest factors in improving in Valorant, always be positive to your team
        mates and have a strong mentality so that you would be able to absorb new ideas and actually learn new
        things in the game, there's a bad habit most players have that they're mostly frustrated when they get
        killed in Valorant, instead, when you die, think about what you could have done better for such situation,
        being hungry to learn new things isn't a bad thing but instead it could help you to improve in Valorant.
        Valorant is a mental game so if you maintain your mentality you will yield results you never expected it to
        happen.</p>
        <h2>Warmup Routine</h2>
        <p>Warming up in Valorant or in FPS games is very important for your aim to improve, and when your aim
        improves you're most likely going to get more frags and lead your team to win, so you should always
        have a proper warmup routine that you tend to follow everyday. There's different styles of warm up
        routines you could follow, for example there's some Professional Players in Valorant that play from 7 to
        10 Deathmatch games everyday before jumping to ranked, scrims or even big tournaments! There's also
        some aim training programs such as Aimlab and Kovaaks you could try, you could also jump into The
        Range and hit some bots in the head everyday. Definitely Warm Up will make you feel better results.</p>
        <h2>VOD Reviewing Your Game Play</h2>
        <p>In order to improve in Valorant, you'll have to record most of your gameplays and watch them when you
        finish playing, while watching your VODS try to write down what you're actually doing wrong and what
        you're doing right in a Notepad, avoid doing what doesn't work properly on your next games, and keep
        doing the same to find out all the mistakes you do in game so you never do them again.</p>
        <h2>Finding The Right Agents</h2>
        <p>It's no secret that Valorant doesn't only depend on aim but also it depends in Agents and Abilities, you
        can always outplay your opponent with your abilities so to do that, you will have to find the agents you're
        comfortable with and to do that you'll have to ask yourself a question, what do I want to play? You have
        the choice to play Duelist, Controller, Sentinel and Initiator. It all depends on you, if you wanna be the
        fragger then you go for duelist, if you wanna support your team, you go for Controller or Initiator if you
        wanna watch the flanks and lockdown sites you might wanna go for Sentinel, then you try out most
        agents and learn them and the ones you feel comfortable with you just spam them.</p>
        <h2>Grind</h2>
        <p>Now you have the mentality, the aim and the right agent, now all you need is time and actually put time
        into the game. The reason professional players are actually very good at the game is that because they
        put so much time into the game and into learning new things, try to find yourself a team so you could
        work more into coordination and strategies, if you don't have that option it's okay, don't be afraid to solo
        queue and always do your best in the games.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'How to get better in Valorant',
            'slug' => 'how-to-get-better-in-valorant',
            'content' => $content,
            'category' => 'valorant',
            'image' => \URL::to('/img/blog/images/valorant-3.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>Like all the competitive games, Valorant also has a ranked system. Valorant actually care about
        their ranked system and tend to do updates often.</p>
        <p>In Valorant, you can't play ranked once you create your game account, you will have to win 10 unrated
        games so you get to play in the ranked game mode, after you finish your 10 unrated wins, you will have
        to play 5 games of ranked so you could unlock your rank since you'll be unranked.</p>
        <h2>What are Valorant Ranks?</h2>
        <img src="/img/blog/content/valorant-ranks.png" alt="Valorant Ranks List" />
        <p>Currently there are 8 tiers of ranks with 3 divisions for each rank except for the final rank Radiant (which
        was previously called "Valorant" in the beta). The ranks are Iron, Bronze, Silver, Gold, Platinum, Diamond,
        Immortal and Radiant. Therefore there are a total of 22 ranks in Valorant.</p>
        <p>Only 500 players will be able to achieve the rank Radiant in each region. Radiant is starting from 400
        MMR.</p>
        <h2>Performance in Ranked Games</h2>
        <p>In Valorant, whether placement games or playing ranked generally, the game always considers your
        game performance so if you perform really well and you lost, you don't lose that much of mmr and if you
        win games with poor performance you don't gain that much of mmr. Winning with huge difference always
        manages to get you so much mmr and vice versa.</p>
        <h2>Valorant Acts</h2>
        <p>Acts are seasons in Valorant. Every Valorant Act will last about two months, and during that time, you’ll
        be able to work on your rank and track your overall progression. There are three Acts in every Episode,
        meaning Episodes last around six months.</p>
        <h2>Skipping Ranks in Valorant</h2>
        <p>Yes, it's true. You can skip ranks in Valorant when you go on huge win streaks, have an incredible
        performance every game and basically be the match mvp for every game. This way the game realizes
        that you don't belong to that specific rank and makes you skip ranks.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'Valorant ranks explained',
            'slug' => 'valorant-ranks-explained',
            'content' => $content,
            'category' => 'valorant',
            'image' => \URL::to('/img/blog/images/valorant-4.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>Valorant have 4 different categories of agents. Starting with, Duelists who are self-sufficient fraggers who
        their team expects to take out engagements first. Then we have the Sentinels who are most likely
        expected to play defensive using their abilities to lock down sites or spots. Moving on, we have
        Controllers who are able to set up sites and smoke different areas of the map. At last, we got Initiators,
        with their abilities they can easily push the opponents away from their positions.</p>
        <h2>Valorant Tier List: September 2021</h2>
        <p>We are asking our professional players about the tier list every patch so you can always come back to check
        this tier list for the latest survey results.</p>
        <img src="/img/blog/content/valorant-tier-list.png" alt="Valorant Tier List" />
        <h2>Agents</h2>
        <p>Currently the game has 16 agent you could choose from, 5 duelists, 3 sentinels, 4 controllers and 4
        initiators, each one got 3 abilities and an ultimate.</p>
        <h3>Duelists</h3>
        <p><strong>Raze:</strong> The amount of damage you could do with raze is just insane. She has a boom bot that you can
        throw to clear angles as when it spots an enemy it starts to chase them until it explodes at them if not it's
        broken. She also has satchels that does a little amount of damage when thrown, players usually use it to
        fly with or reposition themselves as well as she has a very strong nade that does damage and creates
        sub-munitions, each doing damage to anyone in their range. Finally, the showstopper which is her
        ultimate, it's basically a rocket launcher that does massive area damage on contact with anything. Raze
        is very useful on closed and not big maps, like Bind, Ascent and Icebox.</p>
        <p><strong>Jett:</strong> Right now, Jett is the most used duelist in the Professional Scene, she is very fast
        and able to take a shot then run away without getting damaged. What we are talking about is the Dash ability she has.
        She also has 3 smokes that can be used for herself since they don't last for so long, then she has the
        updraft that allows her to get on positions not a lot of agents can get on, finally she has the blade storm
        which is a set of highly accurate knives that recharge on killing an opponent. She is most likely picked in
        every match.</p>
        <p><strong>Phoenix:</strong> He has 2 flashes that could be used as a throw then peek, as well as a molotov that he can
        throw to clear angles or to throw at himself to heal, he can also heal from the flame wall he has which is
        a big wall that creates a line of flame that moves forward and it blocks the vision and damage the players
        passing through it. His ultimate is the "Run it back" - When it is activated Phoenix it instantly place a
        marker at Phoenix’s location. While this ability is active, dying or allowing the timer to expire will end this
        ability and bring Phoenix back to this location with full health.</p>
        <p><strong>Reyna:</strong> After getting a kill with Reyna, a small orb is created and she can choose to either
        heal or dismiss (dismissing means that she becomes slightly invisible and invulnerable for few seconds) - She
        also has a leer that blinds anyone looking at it if not broken. Her ultimate is "Express" which increases
        firing speed, equip and reload speed dramatically. Scoring a kill renews the duration for the ultimate.</p>
        <p><strong>Yoru:</strong> Yoru is a duelist agent made for creative players. His Fakeout allows him to send out
        fake footsteps in a straight line making enemies think someone is there. His Blindside is his version of a flash
        while Gatecrash is his version of a teleport ability. Lastly his Dimensional rift allows him to become
        invulnerable for a certain duration where he can’t fire or be fired upon, or even seen unless you come
        very close to him, giving him great scouting ability or even teleport because he reappears in normal
        dimension when the ability expires.</p>
        <h3>Sentinels</h3>
        <p><strong>Killjoy:</strong> If you're creative enough, you can destroy your opponent with tricky set ups as she
         has 2 molotovs that can be activated manually anytime, as well as a turret that can be placed at places to
        detect enemies and shoot them if seen, she also has an alarm bot that run to the opponent in the radius
        hit him and make him vulnerable then finally she got the "Lockdown" ultimate, after a long windup, the
        device Detains all enemies caught in the radius.</p>
        <p><strong>Cypher:</strong> Cypher has 2 tripwires that can lockdown places, therefore opponents cannot pass by
        except by breaking the wires or by going through it, he has a camera than can be placed and spy on opponents
        and he also got cages that can be activated manually, when someone goes into the cage, there's a
        sound you hear so you get notified that there's an enemy nearby, then finally his ultimate is the that when
        there's a corpse he can activate the ultimate and know opponents places in the map.</p>
        <p><strong>Sage:</strong> She is very simple, she has slow orbs that can slow down opponents as well as a wall
        that can close down places but it can be destroyed. She can heal herself. Your team mates are low HP? No
        problem Sage can heal them too, her ultimate is to revive someone just like in Fortnite.</p>
        <h3>Controllers</h3>
        <p><strong>Astra:</strong> Her power on attack only gets amplified with her Ultimate too. Being able to block
        not just lines of sight, but sound as well, can really throw enemies off in a post-plant. It makes a retake almost
        impossible. Astra’s utility is a little bit less effective on defense. She really benefits from being an active
        player, and not pre-setting utility. Thankfully, she can recall her stars if enemies move, but it’s a bit of a
        hassle. Nevertheless, you can do some pretty neat ability combos in chokepoints. You can pull people
        into grenades, stun narrow corridors, and more.</p>
        <p><strong>Omen:</strong> He can teleport to places you can't go to without abilities, he's also able to support
        team mates with the "Paranoia" flash as anybody in radius of the flash get completely blind and deaf. He also has
        smokes that can set up his team mates to push sites, his ultimate is that he can teleport anywhere in the
        map and surprise the opponents.</p>
        <p><strong>Viper:</strong> Viper is a creative agent because of her fuel meter, which activates two of her
        abilities abilities. When either Poison Cloud or Toxic Screen are activated, the meter starts to decrease. When
        both abilities are off or the meter runs out, it will increase until one is reactivated. Both abilities, as well as
        Viper’s Ultimate, deal decay damage to opponents that recovers when the target leaves the ability, her
        Poison Cloud is basically a smoke and her Toxic Screen is a wall similar to Phoenix's wall, she also got 2
        molotovs that makes enemy vulnerable, her ultimate is one of the best in the game, once activated it
        creates large cloud that reduces the vision range and maximum health of players inside of it.</p>
        <p><strong>Brimstone:</strong> When his stim beacon is thrown, his shots becomes faster therefore the chances of
        killing an opponent is higher, he has 3 three smokes that can set up team mates to push sites and then a
        molotov that does massive damage to anyone staying on it then finally his ultimate is big fire comes from
        the sky does massive damage to anyone staying in it's radius.</p>
        <h3>Initiators</h3>
        <p><strong>Sova:</strong> Playing against a good Sova could be pain in the ass, his Recon Bolt allows you to
        reveal enemies spots if it's not broken, the recon bolt has a 40-second cooldown, so you’ll be able to have
        another one later. His Drone allows you to clear multiple angles and even tag enemies with it so they get
        revealed for 3 seconds, he also got the Shock Darts that do massive damage if anyone got hit with it,
        most importantly is his ultimate, the Hunter's Fury, it's basically an energy blast in a line in front of Sova,
        dealing damage and revealing the location of enemies caught in the line. This ability can be RE-USED
        up to two more times while the ability timer is active.</p>
        <p><strong>Skye:</strong> Skye is becoming a meta lately for Professional players as she can Flash twice with
        her birds, hunt enemies with her wolf and heal her allies then we got her insane ultimate with only 6 points as it
        send out three Seekers to track down the three closest enemies. If a Seeker reaches its target, it near
        sights them.</p>
        <p><strong>Breach:</strong> As most Initiators he can flash twice, he has the Aftershock that can set a
        slow-acting burst through the wall. The burst does heavy damage to anyone caught in its area. Then he got the
        fault line which is a seismic blast that distance can be increased under your choice and daze all the enemies in
        the line, his ultimate is the rolling thunder and it's kinda similar to the fault line but more stronger as the
        quake dazes and knocks up anyone caught in it.</p>
        <p><strong>KAY/O:</strong> The newest Initiator so far, his abilities revolves around the suppression mechanic added with
        Kay/o that disables enemy abilities. Apart from that, he has 2 flashes which is similar to CS:GO's style
        then a throwing knife that disables abilities, a molotov, and an ultimate that also disables abilities,
        combat stims Kay/o, and allows him to be resurrected if he gets "killed".</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'Best Agents in Valorant 2021',
            'slug' => 'best-agents-in-valorant-2021',
            'content' => $content,
            'category' => 'valorant',
            'image' => \URL::to('/img/blog/images/valorant-5.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>It's no secret that since Valorant launched, a lot of Professional and Semi-Professional players switched
        to Valorant, and that's why in this list you are going to see big names of former Counter-Strike players. In
        this list, and after a detailed research, we bring you the top 10 Valorant teams in the world. The teams
        will be listed in order, starting from top to bottom.</p>
        <h2>1. Sentinels</h2>
        <p>North America comes at the number one team in this list, the North American team achieved a stunning
        98 wins with only 21 losses at the moment and them winning Masters 2 in Reykjavik makes their total
        winnings a whopping half a million USD dollars. After the addition of TenZ and Dapr, Sentinels is easily
        the best team in the world at the very moment.</p>
        <h2>2. Gambit Esports</h2>
        <p>Gambit is currently the second-best team in the world and the best team in the whole of CIS and Europe.
        They were able to prove themselves after the roster got signed in late September 2020, and have since
        won the region's VCT events a total of 3 times. Gambit was able to achieve winnings with a total of more
        than $345k in a very short period and they are not done yet.</p>
        <h2>3. Vision Strikers</h2>
        <p>Vision Strikers is the first professional South Korean team to ever enter Valorant, they are formed by a
        roster of former CS:GO players known as MVP PK. The former CS:GO team got disbanded as the
        talents made their switch to Valorant. The Korean stars are currently on the top teams in the world and
        they are very expected to achieve more than they have already achieved judging by their impressive
        66W-3L record according to VLR.</p>
        <h2>4. Team Liquid</h2>
        <p>The European Organization decided to enter the Valorant professional scene by the decision of signing
        the stars - fish123, which gave them the opportunity to exceed their potentials that turned out to be a
        great decision for both parties.</p>
        <h2>5. Acend</h2>
        <p>Formerly it is Team Raise Your Edge, after picking up the roster in March 2021, they have been
        dominating the scene for quite a bit and have won numerous tournaments. Famously, they have added
        Masters Europe: 1 to their name after defeating Team Heretics.</p>
        <h2>6. Envy</h2>
        <p>Envy's Valorant roster is considered to be very solid and it is very interesting to watch them compete
        even though they aren't so consistent as Sentinels, they are still easily in the top 3 in the North America
        region.</p>
        <h2>7. Giants Gaming</h2>
        <p>Giants Gaming entered the Valorant in June 2020 and has since become one of the most successful
        Spanish organizations in Valorant, reaching top finishes in both local and European tournaments.
        However, they have had a lot of roster changes and we believe that they need some time with a stable
        roster to achieve higher rankings.</p>
        <h2>8. G2 Esports</h2>
        <p>They are one of the scariest teams to play against in an official match. The roster has proved that the
        decision of overhauling them was a right one and now they are one of the top rosters in the world.</p>
        <h2>9. Fnatic</h2>
        <p>Since the addition of Nikita "Derke" Sirmitev and Martin "MAGNUM" Penkov, fnatic has been having a
        blast. They were the team to fight against Sentinels in Masters 2, even though they weren't able to take
        them down, they have shown a stunning performance and a good fight, which shows their future
        potential.</p>
        <h2>10. 100 Thieves</h2>
        <p>100 Thieves have a stacked roster, they have a very strong mixture of young firepower and valuable
        experience. Most players in the roster have played Counter-Strike on a very high level nevertheless, they
        have switched to Valorant for a new legacy. 100T were able to qualify to Masters 3 and proceed to
        achieve 3rd/4th place, which is very magnificent.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'Top 10 Valorant Teams 2021',
            'slug' => 'top-valorant-teams-2021',
            'content' => $content,
            'category' => 'valorant',
            'image' => \URL::to('/img/blog/images/valorant-1.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <h2>Achieve at least the Master tier</h2>
        <p>There is a pretty huge skill difference between someone who is consistently low master and someone
        who is consistently high challenger but being at least master proves that you are serious about the game
        and it shows that you at the very least and know how to practice and improve your gameplay, there's a
        lot you can do to move from master and challenger whether it's working on your mechanics or game
        knowledge but you need to already be at that point before you even start thinking about trying to go pr,
        most organizations are only going to look for the best so you've got ton of competition, so aim to climb as
        high as you can on the ladder and this can definitely be easier for some players than others but making a
        name for yourself as a good player is never going to hurt your chances.</p>
        <h2>Network and build relationships</h2>
        <p>Making friends in higher elo and forming connections is huge for getting on a team. The more people you
        know the more likely someone might mention you as a possible player. Work on making friends and not
        making enemies as you climb the ladder. If you are not getting anywhere it is probably because you are
        missing this part in the industry.</p>
        <h2>Do not be toxic</h2>
        <p>Even though there were some players who were toxic and ended up getting in the professional industry,
        this shouldn't be your goal. If you are actually looking to build up a career in the game then you should
        always be a nice person so your chances gets high of becoming a pro player, don't flame your team in
        game and always maintain your mentality then you might be noticed that you would be a good fit in a
        team environment.</p>
        <h2>Build up your clout</h2>
        <p>If you are looking to become a pro then you might want to get known, try to stream on Twitch to show off
        what you got of skills, make a Twitter as every pro player has a twitter so that people can follow you so
        you can get connections easier. The more places you are available on the more likely you will be
        noticed. If you only play League and don't use anything else, it will be very hard for teams or players to
        take notice of you.</p>
        <h2>Be flexible</h2>
        <p>It is possible to go pro not knowing many champions but you are more likely to be selected for a spot if
        you are a flexible player. Try to learn as many champions for your role as you can and be as proficient as
        possible with them. Don't just be ok at each champion, be great with as many as you can. The more
        flexible you are the, the better player you will be overall.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'How to go pro in League of Legends',
            'slug' => 'how-to-go-pro-in-league-of-legends',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-1.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>Ever since the boosting industry launched, the game League of Legends has always had it's unique
        numbers of clients who are interested in buying ELO Boost, and to buy ELO Boost, you just need to pick
        a trusted site that provides quality service. The prices for ELO Boost usually varies from site to site. Each
        rank has different prices but the difference is very close in numbers.</p>
        <h2>What are the average prices of ELO Boost in LOL?</h2>
        <p>As it mind sound cliché, the prices get higher from lower ranks to higher ranks and there's a lot of
        features you could use while using boosting sites, such as Duo Queue Service which makes you play
        with the booster and experience everything, if you don't want to play and would just like to watch, there's
        the Stream option where the booster could just stream the game for you on any platform of your choice
        and a lot more features you could use during your boost.</p>
        <p>So we have made a study below of the average prices in ELO Boost depending on each rank:</p>
        <ul>
            <li>Average price per Division in Iron Rank is 7 Euros</li>
            <li>Average price per Division in Bronze Rank is 8 Euros</li>
            <li>Average price per Division in Silver Rank is 10 Euros</li>
            <li>Average price per Division in Gold Rank is 14 Euros</li>
            <li>Average price per Division in Platinum Rank is 20 Euros</li>
            <li>Average price per Division in Diamond Rank is 50 Euros</li>
        </ul>
        <h2>Average Prices of Rank Boosts</h2>
        <ul>
            <li>Gold I - Platinum IV = 40 Euros</li>
            <li>Gold I - Platinum IV + Duo Queue = 55 Euros</li>
            <li>Bronze I - Platinum IV = 250 Euros</li>
        </ul>
        <p>Please be bear in mind that these prices are only average and as we said before, prices vary from site to
        site, those are only an estimation according to a study that Eloking has made. Nevertheless, Elo
        boosting sites should have price calculator, where you just enter all your ranks, LP and what kind of
        boost you need, whether duo queue or solo and finally enter your desired rank and the calculator will
        give you a final price of the whole service.</p>
        <p>To know what boosting site you should pick then you should make a decent research to decide which
        site you are going to use. But if you are ever looking for a decent price with high quality boost and 24/7
        customer service, then Eloking should be your way to go.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'League of Legends Boosting Prices 2021',
            'slug' => 'lol-boosting-prices-2021',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-2.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <h2>What is ELO Boost in League of Legends?</h2>
        <p>ELO Boost services is what you use when you are in need of a helping hand to make you reach your
        desired rank/division.</p>
        <h2>Why do players use ELO Boost?</h2>
        <p>It is not a secret that League of Legends is full of smurfs, trolls and people who are not willing to actually
        put effort in game and therefore results in lots of loses. Even though some players think that they got
        what it takes to be a higher rank, they can't achieve that because of these factors, therefore, they use
        ELO Boost services so they can guarantee a higher rank/division. As well as some players has no time
        to put so much time into the game so they let a professional indvidual play on their account to help them
        achieve higher ranks.</p>
        <h2>Duo Queue Elo Boost</h2>
        <p>Duo Queue service in Elo Boost is one of the most fun services you can buy. If you're just tired of losing
        and getting deranked but you still don't want to give out your account details, then you choose the DUO
        Queue service. With this, you don't have to give out your account details and you will have a professional
        player available to queue up with you and help you reach your desired rank, it's basically like playing with
        a friend but the main point here is that - that "friend" will be quite good at the game.</p>
        <p>Duo Queue boosting is risk free and you can't get banned for it as it doesn't violate the terms of the
        game. It is also more expensive than solo boosting as well as it is takes more time to complete the job.</p>
        <h2>Why should you pick Eloking as your main ELO Boost provider?</h2>
        <p>The boosting market is full of cheap low quality boosting and coaching providers where professional
        players can only focus on quantity and therefore many boosts are left unfinished, customers are being
        flamed on and overall the average experience is not good. With us it is a completely different story -
        we're fully focused on customers and want all of our customers to be long-term repetitive customers. Our
        boosters are compensated properly and we value quality over quantity, therefore we strive to providing
        the best boosting and coaching experience in the market. While most boosting sites are operated by
        individuals, Eloking is an official company Eloking Ltd., registered in Riga, Latvia.</p>
        <p>There is only a handful of companies that can be called our competitors and when being compared with
        them, we are almost always better on the price even though our boosters are compensated the same or
        even more, making us an obvious choice for both - customers and professional players.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'How boosting works in League of Legends',
            'slug' => 'how-boosting-works-in-lol',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-3.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>We have asked one of our challenger boosters in our team about some tips and tricks he wish he knew
        back then before hitting the challenger rank and he filled us with some of very cool tips and tricks that we
        are sharing with you today and it will definitely help you rank up or improve your gameplay.</p>
        <h2>When to forfeit the game</h2>
        <p>Most people just press the surrender button and forfeit the game over reasons what it's not necessarily a
        loss just yet, sometimes it's just hard to determine when to forfeit because you won't want to give up a
        winnable game but you also don't want to waste more time in a game that it is already lost. We think that
        forfeiting should be necessary on three trinity factors, which are, scaling, wave clear and range; if your
        team has better scale than the opponent's then it means a lot of things, scale just means their abilities
        and champion kit is superior to most champions in the late game and the more impactful then the longer
        the game goes. Wave clear is super important because it indicates how fast or slow you have to give
        towers in the mid game when you are losing. Range is just as important because the longer your range
        is on your abilities the further you can be away from your enemies as the game stalls, but none of this
        important if their scale, wave clear and range is better than yours. So never forfeit no matter how behind
        your team is, you can always comeback.</p>
        <h2>Dodging to climb</h2>
        <p>Dodging is really effective to climb elo because the maximum LP loss is significantly lower than actually
        losing a game and you don't lose MMR for dodging so, as long as you are winning the games that should
        be won, you will maintain higher gains than losses, then you will be able to climb to high elo with a higher
        winrates. There are many factors that you can spot to validate a dodge, like if your team mate is only
        really bad win streak then you should kind of expect his mentality of how determined his to be willing to
        win the game, but make sure to only judge his recent matches on the same day or closer to that.</p>
        <h2>Laning Optimally</h2>
        <p>Playing your lane optimally has a lot to do with when your champion can actually pressure and your lane
        and jungle matchup, for example, if you're playing Zedd and I'm versing a LeBlanc/Elise matchup, your
        first priority should be isn't pushing the lane because you're dead if a single chain lands even if you flash,
        but if you're versing Vladimir/Rengar, you can prioritize pushing, because they have a little threat to you
        in the laning phase.</p>
        <h2>Mastering one role</h2>
        <p>In order to learn everything about a role you need to play over and over again so you become
        experienced with it, the more you play it, the better you get, the chances if you winning a game will most
        likely getting higher. So try to master specific champions for that positions so that you'll become a more
        competitive player.</p>
        <h2>Being honest with yourself</h2>
        <p>If you're a silver or a gold player, you're likely not going to hit diamond in a week, if you're a bronze or an
        iron player, you're likely not going to hit gold in a week. Getting better at this game takes time and most
        importantly, patience, if you want to improve then you need to be honest with yourself and look at your
        current skill level, put your ego aside, stop blaming your team mates and work on self improvement,
        setting realistic goals with specific milestones in between will make you get to your next goal easier.
        Maybe your goal is just to win one game per day, whatever it is it's important that you understand just
        how much time and dedication it takes to get better, it's hard to slow things down and smell the roses
        along the journey because we all want to see that finish lines of that challenger elo, however if you get
        over this hurdle and learn to grow then you will become a much better player overall and a better person
        overall.</p>
        <h2>Buying ELO Boost</h2>
        <p>If you need a helping hand reaching your desired rank, then Eloking should be your choice. Eloking has
        a big number of professionals that could help you reach the rank of your dreams, so don't hesitate and
        order League of Legends Elo Boost now.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => '6 Advanced Tips and Tricks from a Challenger Player',
            'slug' => '6-advanced-tips-from-challenger-player',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-4.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>A lot of players especially the newer ones will struggle to find a role that suit them best, while we can't
        guarantee that we will find the best role for you but we will definitely help you pick the role that flows with
        your play style.</p>
        <h2>Top Lane</h2>
        <p>Top lane is actually quite an important role as it allows for a ton of different play styles but most
        importantly it's one of the most isolated roles in League of Legends, while the others do interact with
        each other quite often. Top lane is best known for an island, but don't worry you can often take teleport to
        Rome in order to help your team. As a top laner you're constantly looking to outplay your opponents by
        either staying safe and scaling or dominating them out of pure skill, it's constantly a battle of wits and
        depending on your champion. One advantage is all it takes to carry your team to victory, so with this in
        mind it means that you'll be in a 1v1 scenario for most of the game, if you're into solo oriented playstyle,
        top lane can offer a more enjoyable experience.</p>
        <h2>Jungle</h2>
        <p>It is similar to top lane, the jungle is a fairly solo oriented role or at least for a part of the game, it's best
        known for it's ability to impact every lane of the game and tends to control what objectives are taken,
        alongside this, junglers farm camps rather than minions and gank lanes meaning that then don't have an
        actual lane opponent while most junglers may occasionally clash at scuttle or during invades if necessary
        it's possible to completely avoid the enemy jungler to avoid being killed yourself, with that being said, as
        a jungler it's up to you to either carry the game or put your team in a position that they can carry, this
        means you will often have to prioritize having extremely high farm and experience or you will be looking
        to constantly gank your allies and getting them ahead. If you're somebody who wants to have a lot of
        control over the game, then Jungle is your way.</p>
        <h2>Mid Lane</h2>
        <p>It is arguably one of the most popular roles in the game, alongside it's popularity, it boasts one of the
        highest shampoos as well which is allows for a lot of different play styles, with that being said, it's
        position is quite literally in the middle of the map which allows them to impact all other roles quite easily,
        it has a nice combination of jungle and top lane characteristics as a mid laner, it's best to consider you
        and your jungler as a duo, this is because you are uniquely able to help your jungler as fast as possible
        pretty much constantly considering that you have the shortest lane and it's the best central on the map,
        there are a variety of different play styles so whether you're looking to farm to late game, roam with your
        jungler or burst people as an assassin, you'll surely find a champion that suits for you.</p>
        <h2>Bottom Lane - ADC</h2>
        <p>If you ever played a lot of mmo rpgs then this role will feel kinda similar to you. The role of ADC is best
        known for it's highest role with also some of the longest range, yet, having the lowest health bars. The
        entire goal of an ADC is to dish out as much damage as possible before dying, their kits often allow them
        to scale incredibly well into the late game when compared to other champions, but they still have various
        play styles, while they may not have as many champions as other roles in the game, it's still extremely
        fun to be the person who is going to be doing all the damage. Bear in mind that everyone on the enemy
        team is also going to be trying to kill you. So be careful with that.</p>
        <h2>Bottom Lane - Support</h2>
        <p>They are in the bottom lane with the ADC, and usually aim to either protect them early on or get them
        ahead, plus sometimes they will even gank mid to help get their mid laner ahead as well. They're on of
        the best primary methods of your team to gain vision control, this means that they're often looking to
        prepare objectives or set up vision in order protect the team from just blindly walking into the fog of war.
        They're quite literally the team's biggest supporters, Supportive champions are built to help their team out
        in one way or another so whether getting the ADC ahead or something in between. Support has
        something for everybody to enjoy, so if you're looking to help your team then support is your choice.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'League of Legends Best Role 2021',
            'slug' => 'lol-best-role-2021',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-5.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>Solo queuing in League of Legends is definitely not an easy thing to go through, therefore, with
        this topic we are going to give you tips on how to solo carry in League of Legends, if you follow
        everything below then we are sure that you will be able to have better gaming experience.</p>
        <h2>Pick The Right Champion</h2>
        <p>It is no secret that right now, the game has 157 champions which you could pick from, now the question
        here is, which champion should I pick to Solo carry? Well you might want to pick very strong champions
        in order to carry your game. As the game has 5 roles, we have placed the strong champions on each
        role below:</p>
        <ol>
            <li>Top - Malphite, Garen, Volibear, Sett, Ornn</li>
            <li>Jungle - Olaf, Hecarim, Karthus, Nunu & Willump, Zac</li>
            <li>Middle - Annie, Malzahar, Veigar, Orianna, Ahri</li>
            <li>ADC - Tristana, Ezreal, Kai'Sa, Ashe, Sivir</li>
            <li>Support - Leona, Nautilus, Morgana, Lulu, Alistar</li>
        </ol>
        <p>Now let's say that you picked the champion for your role, now what's next?</p>
        <h2>One Tricking</h2>
        <p>The term one tricking is thrown around a lot in League of Legends, if you one trick a champion it
        means that you completely put all of your time and effort into that one champion, this means
        that a large portion of your games are on that specific champion, in turn, this allows you to
        slowly gain a lot of experience with that champion. This dedication is one the most parts of one
        tricking, however that doesn't mean that you should spam games with that one champion, you
        can pick 3 or 4 champions from the list above and get them to their maximum.</p>
        <p>One tricking shouldn't be underestimated or undervalued and every good player in League of
        Legends always consider this trick to carry their solo games.</p>
        <h2>Be Greedy With Resources</h2>
        <p>With the exception of support players, you need to make sure that you look out for number one
        which is the MVP, this means that you should take as much farm as you can, as many camps
        as possible, and as many resources as your team can give you. You only have one factor you
        can truly control, yourself, so that means you should make yourself as strong as possible,
        because you know you can carry but you can't be so sure about your teammates, your
        teammates can be a gamble sometimes, so your best bet is on yourself.</p>
        <h2>Believe In Yourself</h2>
        <p>Yes, you got to be as much confident as you can be in order to solo carry your games in League
        of Legends, if you're going into a game with zero confidence then you're most likely already lost
        this game, you should always encourage yourself that you're the best player in the server and
        you have what it takes to bring that game to yourself.</p>
        <h2>Buy Elo Boost</h2>
        <p>If you're unable to carry your games, at Eloking, we have a big number of Challenger players
        who are willing to get you to your desired rank, so hurry up and order League of Legends
        boosting service now.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'How To Solo Carry In League Of Legends',
            'slug' => 'how-to-solo-carry-in-lol',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-1.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>Even though it's safe to say that the MOBA game, League of Legends, doesn't have a whole specific
        story to tell about the game itself, the characters themselves have very interesting backstories that take
        place in a world called Runeterra.</p>
        <p>After 10 years of releasing the famous League of Legends, Riot Games announced that they will release
        a connected series to League of Legends, Arcane that will be starring the game's champions/characters.</p>
        <p>Arcane's story gets to happen in the city of progress which is called Piltover and the undercity that is
        called Zaun, where two sisters fight on opposite sides of a war between magical techniques and
        conflicting beliefs. The series presents the origins of two iconic League of Legends champions who are
        Jinx and Vi which are the main characters of the series, there are also other characters such as Caitlyn,
        Jayce, Ryze, Viktor, Heimerdinger, Ekko, and Singed.</p>
        <h2>Arcane's Popularity</h2>
        <p>Since Arcane was released, it has been and still blowing up and it got a whopping 130 million worldwide
        views 3 hours after the show was released. Arcane opened the gates for famous game producers to start
        creating such a production and we expect that we will see TV Shows for more games in the near future.
        It has been confirmed that Arcane has ranked first in the list of the top 10 most-watched series on Netflix
        in 37 countries and that makes Arcane beat the famous Korean show Squid Game.</p>
        <h2>Arcane and League of Legends' Lore</h2>
        <p>Piltover is the overworld and Zaun is the underworld basically, Piltover is the more advanced
        technologically capable area with the more rich, higher class society members, now Zaun is basically
        both figuratively and literally below Piltover, Zaun is a much lower class, higher crime rate, more poor
        people filled society and it's basically the underworld of Piltover while also being literally under Piltover.</p>
        <h2>Arcane and New League of Legends Champions</h2>
        <p>It's no secret that there were some new champions that aren't in the League of Legends' champion pool
        such as Silco, Mel and Ambessa Medarda, Deckard, Finn, Mylo, Claggor, Bolbok, and Sheriff Marcus
        and we expect those names in future updates.</p>
        <p>The lead champion producer Ryan "Reav3" Mireles answered in a Reddit post - “Arcane has resonated
        with so many players, Champs team is definitely excited to explore characters from Arcane, that would
        make sense in a MOBA, in the future." and that proves that we will see some Arcane Characters soon.</p>
        <h2>Is there a Season 2 of Arcane</h2>
        <p>The Co-Creators, Christian Linke and Alex Yee recently made an announcement on the 20th of
        November - "We're beyond happy about the positive response to Arcane's first season and we are
        working hard with the creative wizards at Riot and Fortiche to deliver our second installment" therefore,
        it's been revealed that season 2 was in production at the time of the announcement that means that
        writing and storyboarding for continuing the characters is on its way. Arcane's season 1 was originally
        meant to air in 2020 but the global health issue pushed things back to November of 2021, if there are no
        more delays we can expect an earlier release for the second installment.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'Is Arcane Connected To League Of Legends',
            'slug' => 'is-arcane-connected-to-league-of-legends',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-2.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>A common question that is being asked nowadays in League of Legends, is it okay to smurf in League of
        Legends? Is smurfing ban-able? Within this post, we are going to answer this common question.</p>
        <p>First we need to know <strong>what smurfing is</strong>. Smurfing is when a player in a certain rank plays on
        another account which has a rank that is lower than his actual rank, therefore it becomes easier for that
        player to play on that specific level.</p>
        <h2>Can you get banned for smurfing in LoL?</h2>
        <p>The simple answer is No, smurfing isn't against League of Legends' Terms of Service. You can't get
        banned for smurfing. Some players usually own tons of alternative accounts and they never get banned.</p>
        <h2>Why isn't smurfing banned in LoL?</h2>
        <p>Even though it might sound disappointing for you, but, game creators actually love smurfs and
        encourage them even though they will never tell. Smurfs bring the game a lot of money, that could be
        from buying more skins in alternative accounts or even streamers who would smurf to play with their
        friends.</p>
        <h2>Why do people smurf in LoL?</h2>
        <p>There's many reasons why a player could potentially smurf, such as, a player who wants to play with his
        lower rank friends so he just hops on a smurf account to do that, a player who is tired of playing against
        his own rank since it's not that easy for him so he just goes against lower ranks, therefore, the games
        become easier for him, a player who wants to troll games or grief for his own pleasure and finally, a
        player who does ELO Boosting service, now what is ELO Boosting Service?</p>
        <h2>How is ELO Boosting connected to smurfing?</h2>
        <p>ELO Boosting is when a professional/high rank player logs into a Boostee's account (The person who is
        getting boosted) and plays on his account until he reaches his desired rank. Due to Riot' Rules, any
        ranked game played by someone that is not the original creator of the account may be considered
        Boosting and as a result may be eligible for punishment.</p>
        <p>If your account was guilty of MMR / ELO Boosting, it is possible that the following is going to happen:</p>
        <ol>
            <li>2 Week Account Suspension in League of Legends</li>
            <li>Your Honor will drop to level 0.</li>
            <li>Exclusion from receiving the current season's Ranked Rewards</li>
        </ol>
        <p>And you could also get permanently banned if you were caught in second offense.</p>
        <h2>Conclusion</h2>
        <p>Smurfing is safe to do but ELO / MMR boosting is risky if you're not going to choose a safe ELO Boosting
        provider.</p>
        <p>At Eloking, we have never encountered any cases of account suspension. Since we guarantee our
        customers safe boosting experience and guaranteed compensation if anything happened that
        would affect the satisfaction of our customers, you should always have Eloking as your top boosting
        service provider.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'Is Smurfing Safe In League Of Legends',
            'slug' => 'is-smurfing-safe-in-lol',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-3.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>As with any other game or sport, you play against people/players with a similar rank, you compete
        against each other to determine who is the best in this skill group, and if you prove that you're not in this
        skill group anymore, you get a higher skill group. For example, English football has 7 levels. League of
        Legends has 9 Rank Tiers, Iron, Bronze, Silver, Gold, Platinum, Diamond, Master, Grandmaster, and
        Challenger. To play in Ranked you first need to get level 30 in the game then you get to play 10
        Placement matches for the system to determine your rank. There are 4 divisions in League of Legends:
        IV, III, II, and I with one being the best.</p>
        <h2>Ranks Distribution</h2>
        <ol>
            <li>Iron: 1.8%</li>
            <li>Bronze: 18%</li>
            <li>Silver: 36%</li>
            <li>Gold: 29%</li>
            <li>Platinum: 12%</li>
            <li>Diamond: 1.5%</li>
            <li>Master: 0.13%</li>
            <li>Grandmaster: 0.025%</li>
            <li>Challenger: 0.010%</li>
        </ol>
        <h3>Iron</h3>
        <p>This is where players are still in the learning stages of the game. If you're Iron, the main thing you have
        to focus on is, learning the fundamentals, because as an Iron, you have to learn a lot of different things,
        however, understanding those basics is not as easy as some players think it is. People who think that
        probably have been playing League of Legends games for quite a while now so it's easy to forget how
        hard it is to pick up this stuff when you're first starting off. You really want to focus on farming, paying
        attention to cooldowns, and adjusting your playstyle based on the cooldowns themselves as well as
        trading, farming, and knowing how to path efficiently if you're jungling. Something like wave management
        is also a thing you'll have to start learning eventually but you're not expected to master any of these
        things to get out of Iron, all you have to do is start practicing them and then begin developing them and
        at some point, you'll simply get good enough to climb out of iron.</p>
        <h3>Bronze</h3>
        <p>If you're Bronze, congrats since you made it out of Iron. At the very least, this means you have a
        rudimentary understanding of the game's fundamentals, but we've got two tips that you should start
        working on, if you're in Bronze, you should start getting the maximum out of your minimap, unfortunately,
        the mini-map isn't going to be as effective if you don't have any vision, while vision is a team effort that
        affects the entire flow of games. The second tip is that you need to learn to play more aggressively,
        what's essential to make this tip work is that you need to be learning something while you can easily
        watch a replay and tell yourself that you ran it down, you should be learning why you ran it down, what
        circumstances made your aggression a bad play, so you should think about your plays and review them
        to improve your gameplay.</p>
        <h3>Silver</h3>
        <p>Silver is definitely the most popular rank in League of Legends, and getting out of Silver isn't that easy. If
        you're Silver and you would like to get out of it then you should start thinking about things from your
        opponents' perspective, this applies in several different ways, you probably have a good idea of what
        your own game plan is, you want to win your lane or scale up by doing whatever your champion is strong
        at, by now you should easily recognize that your opponents have an idea of what they want to be doing
        as well. In Competitive games, like LoL, knowing what you're going to do is very important but it's equally
        as important to know what your opponent wants to do, so start predicting and win games.</p>
        <h3>Gold and Platinum</h3>
        <p>If you're Gold or Platinum then you should focus on your macro-play, if you want to make it out of Gold or
        Platinum, you need to be able to consistently make the right choice, prioritizing the correct objectives,
        knowing which objectives that you can take after a team fight and where you need to be at certain stages
        of the game, those are all concepts that will help you win your games. If you get to find toxic players in
        your games then mute them all and focus on your game.</p>
        <h3>Diamond</h3>
        <p>Being Diamond makes you better than 98.5% of the players. If you would like to reach Master or even
        further ranks then you should consider spamming the game as much as you could, that's probably the
        only way that could make you exceed through higher ranks, the more you play, the more experience you
        get and the much better you get.</p>
        <h3>Master and Grandmaster</h3>
        <p>Now that's where things start to get serious and League of Legends doesn't become a game that you
        only play for fun, by only getting those high ranks, the chances of having an income from the game is
        very high, you could possibly stream or even start working for a boosting site and start making some
        money from your pwnage skills.</p>
        <h3>Challenger</h3>
        <p>Made it through Challenger? Congratulation, you're officially a professional League of Legends player
        and you should start looking for a team and compete in big stages with the big boys. Make a Twitter and
        make yourself known and let the whole world know that you've achieved this rank because trust me, this
        is not an easy thing to do and you're definitely something else.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'League of Legends Ranks',
            'slug' => 'lol-ranks',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-4.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);

        $content = <<<HERE
        <p>Tenacity is a stat that reduces the duration of crowd control effects that you suffer from, it cannot reduce
        their duration below 0.5 seconds, it's basically Crowd Control Reduction. There are just three exceptions,
        three types of crowd control that are not subject to tenacity.</p>
        <ol>
            <li>Suppression</li>
            <li>Stasis</li>
            <li>Displacements</li>
        </ol>
        <h2>How To Acquire Tenacity</h2>
        <p>You can contain The Legend Tenacity rune from the precision tree, which can give you up to 30%
        tenacity. There's also The Unflinching Rune in resolve, which gives you 10% tenacity for each of your
        summoner spells and cooldown, which stacks up to 20%, therefore, it stacks additively, additionally, you
        get 15% slower resist and additional tenacity which is however multiplicative for 10 seconds when you
        activate a summoner spell, there's also a summoner spell that is capable of giving you tenacity -
        Cleanse, it gives you 65% tenacity for 3 seconds upon activation, in addition to removing all disables
        excluding suppression and airborne. You can also acquire tenacity from Champion Kits, Items and
        Elixirs.</p>
        <h3>Champion Kits:</h3>
        <ol>
            <li>Garen's Courage - It gives you 60% tenacity for 0.75s</li>
        </ol>
        <h3>Items:</h3>
        <ol>
            <li>Mercury’s Treads - Those boots also give you a nice amount of magic resist and 30% tenacity</li>
            <li>Silvermere Dawn - It gives you 40% tenacity</li>
            <li>Sunfire Aegis - It gives you 5% tenacity</li>
        </ol>
        <h3>Elixirs:</h3>
        <ol>
            <li>Elixir of Iron - It gives you 25% tenacity</li>
        </ol>
        <h2>How Can Those Stack</h2>
        <p>Generally stacking tenacity is worth it, it's not that great but on certain champions it works. Tenacity is
        very important for bruisers and not for squishes, because if you're a bruiser, players are focusing on you
        and you need to somehow survive and deal damage at the same time.</p>
        <p>There are combinations that stack additively such as Elixer of Iron with Unflinching - Mercury’s Treads
        with Sterak’s Gage, all the other combos will stack tenacity with multiplication.</p>
        <h2>What Is The Maximum Tenacity Possible</h2>
        <p>Garen can now reach a huge 98% tenacity, even though it's only for 0.75s.</p>
        <h2>Is It Possible To Reduce Tenacity</h2>
        <p>Yes, Tenacity can be reduced to negative values, causing crowd control to last longer.</p>
        <ol>
            <li>Ornn's Bellows Breath and Call of the Forge God Call of the Forge God apply Brittle, which is a
            unique status effect that reduces tenacity by 30%.</li>
            <li>Anathema's Chains reduces the Nemesis' tenacity by 20% while at maximum stacks of Vendetta.
            This stacks multiplicatively with Brittle for a total of -56% tenacity.</li>
            <li>Rift Scuttler has -100% tenacity, doubling the duration of crowd control effects applied to her. This
            stacks additively with Brittle for a total of -130% tenacity.</li>
        </ol>
        <h2>Is Tenacity Important</h2>
        <p>Tenacity is great since it increases your mobility and if you have the right tenacity build, it is most likely
        that you're going to shut down a lot of popular crowd control champions and possibly make difference for
        your team so you should always consider tenacity since it might help you save your champions life and
        possibly get you in higher ELO.</p>
        HERE;

        DB::table('blog_posts')->insert([
            'title' => 'What is Tenacity in League of Legends',
            'slug' => 'what-is-tenacity-in-lol',
            'content' => $content,
            'category' => 'lol',
            'image' => \URL::to('/img/blog/images/lol-5.jpg'),
            'status' => \App\BlogPost::STATUS_PUBLISHED,
        ]);
    }
}
