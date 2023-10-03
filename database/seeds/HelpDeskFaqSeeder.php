<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HelpDeskFaqSeeder extends Seeder
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
                'question' => 'How soon after placing the order we can play?',
                'answer' => 'It can depend based on the time of order but typically our boosters start communicating with our customers within 10 minutes. If you want to start right away, feel free to message in our live chat to check approximate starting times. Most likely, we will be able to find a booster ready to play at your desired time due to the fact we have a large number of boosters working with us.',
                'categories' => 'League of Legends',
            ],
            [
                'question' => 'What happens if the booster loses a game?',
                'answer' => 'It depends on the order details. If it is a level boost, the booster will play as long as the goal is achieved. If you order win boost then losing a game means the booster will play extra games. Each loss will be compensated with 2 wins to offset the loss. For example, if you ordered 3 wins and on the 3rd game the booster lost the game, the booster will play 2 more games - 1 to offset the loss and another one to fulfill the order.',
                'categories' => 'League of Legends',
            ],
            [
                'question' => 'What happens if the booster promotes to a higher level during NET wins?',
                'answer' => 'If the booster promotes during the boost, he will play one less from the remaining games. For example, if he promotes with 5 wins remaining, he will only play 4.',
                'categories' => 'League of Legends',
            ],
            [
                'question' => 'Can I watch my booster play?',
                'answer' => 'Of course, make sure to select the Live Stream add-on before placing your order, this way the booster will stream for you the games on either Twitch or YouTube',
                'categories' => 'League of Legends',
            ],
            [
                'question' => 'Can I play with my booster?',
                'answer' => 'Yes, we provide duo queue boosting service (Play with Booster add-on) so you can experience everything live. Purchasing duo queue boosting will definitely give you that option.',
                'categories' => 'CS:GO,League of Legends,Valorant',
            ],
            [
                'question' => 'What if booster contacted me directly and offered me their services?',
                'answer' => 'We offer free services and discounts for clients who report such cases to us, please contact Live Chat if such thing happened.',
                'categories' => 'CS:GO,League of Legends,Valorant',
            ],
            [
                'question' => 'Can I play when my order is in progress?',
                'answer' => 'No, when a division boost is in progress, playing without booster\'s involvement is strictly forbidden. However, if you play and lose, an extra payment will be required to compensate for the lost games and the boost will resume. If it is a net wins order then your individual games won\'t be counted.',
                'categories' => 'League of Legends,Valorant',
            ],
            [
                'question' => 'Can I play when my order is in progress?',
                'answer' => 'No, when a rank boost is in progress, playing without booster\'s involvement is strictly forbidden. However, if you play and lose, an extra payment will be required to compensate for the lost games and the boost will resume. If it is a net wins order then your individual games won\'t be counted.',
                'categories' => 'CS:GO',
            ],
            [
                'question' => 'Can I get a refund?',
                'answer' => 'We are the most flexible company for refunds. Order not yet started? We offer refunds without any reasons. Changed your mind and just don\'t want to finalize the boost? No problem, we can stop the boost mid-way and offer you a reasonable refund.',
                'categories' => 'CS:GO,League of Legends,Valorant',
            ],
            [
                'question' => 'Can I change the booster for my order?',
                'answer' => 'Of course. In this case, contact our Live chat and you will get another booster to serve you and possibly a small compensation if your experience with the previous booster wasn\'t great.',
                'categories' => 'CS:GO,League of Legends,Valorant',
            ],
            [
                'question' => 'Will anyone know that I\'m being boosted?',
                'answer' => 'Not really. While there will be a notable difference in the skill of the booster and you, the booster will not share any details about you and they will also not tell anyone that you are being boosted. It is possible to also agree on certain things with the booster, i.e., to have him play in offline mode if they play using your account. That kind of things are available free of charge. It\'s safe to say that our boosters are very quiet while boosting any account at any level.',
                'categories' => 'CS:GO,League of Legends,Valorant',
            ],
            [
                'question' => 'Can I get banned using your services?',
                'answer' => 'In matchmaking - no. In highly competitive platforms such as Faceit - very unlikely. All of our orders are done with pure skill, we don\'t use any kind of cheats/exploits or even bots. So it is nearly impossible to get banned for our boosting service. However, such platforms like FACEIT or ESEA prohibits multi-accounting as well as boosting, so that makes you responsible for such violations even though we have never faced any bans on any platforms since we use all the security measures.',
                'categories' => 'CS:GO',
            ],
            [
                'question' => 'Who will boost my account?',
                'answer' => 'We have a large amount of professional CS:GO players and the order will be picked up by a booster who match certain criteria. We only hire individuals who are FACEIT 3k Elo or more so you shouldn\'t be worried about the skill level of our boosters since we have got a good number of very talented players.',
                'categories' => 'CS:GO',
            ],
            [
                'question' => 'Will my items/skins/balance be safe?',
                'answer' => 'Definitely. We have very strict rules and agreements in place for our boosters in this matter. Although, we highly recommend turning on Steam Guard anyways to make sure your account is safe (even if you are not ordering a solo boost).',
                'categories' => 'CS:GO',
            ],
            [
                'question' => 'Can I get banned using your service?',
                'answer' => 'We haven\'t encountered any ban cases for solo boosts at Eloking. Our boosters use all the security measurements to avoid such cases, however, if anything went wrong, feel free to contact our live chat for possible compensation since we care about the satisfaction of our customers. For our Duo queue services, it\'s not possible to get banned for that since it doesn\'t violate Riot Games TOS.',
                'categories' => 'Valorant',
            ],
            [
                'question' => 'Can I choose specific agents/heros that my booster may play with?',
                'answer' => 'Yes and that is free of charge. After you place your order you\'ll get the opportunity to choose what agent our booster will play with.',
                'categories' => 'Valorant',
            ],
            [
                'question' => 'Will my items/skins/vp be safe?',
                'answer' => 'Definitely.  We have very strict rules and agreements in place for our boosters in this matter.',
                'categories' => 'Valorant',
            ],
            [
                'question' => 'Who will boost my account?',
                'answer' => 'We have a large amount of professional Valorant players and the order will be picked up by a booster who match certain criteria. We only hire individuals who are Radiant rank so you shouldn\'t be worried about the skill level of our boosters.',
                'categories' => 'Valorant',
            ],
            [
                'question' => 'Can I get banned using your service?',
                'answer' => 'We haven\'t encountered any ban cases for solo boosts at Eloking. Our boosters use all the security measurements to avoid such cases, however, if anything went wrong, feel free to contact our live chat for possible compensation since we care about the satisfaction of our customers. For our Duo queue services, it\'s not possible to get banned for that since it doesn\'t violate Riot\'s Term of Service.',
                'categories' => 'League of Legends',
            ],
            [
                'question' => 'Can I choose specific agents/heros that my booster may play with?',
                'answer' => 'Yes and that is free of charge. After you place your order you\'ll get the opportunity to choose what agent our booster will play with.',
                'categories' => 'League of Legends',
            ],
            [
                'question' => 'Will my items/skins/be/rp be safe?',
                'answer' => 'Definitely, we have very strict rules for our boosters in this matter, the booster\'s mission is to get you to the desired rank and then log off the account.',
                'categories' => 'League of Legends',
            ],
            [
                'question' => 'Who will boost my account?',
                'answer' => 'We have a large amount of professional League of Legends players and the order will be picked up by a booster who match certain criteria. We only hire individuals who are Challenger rank so you shouldn\'t be worried about the skill level of our boosters.',
                'categories' => 'League of Legends',
            ],
            [
                'question' => 'Are Eloking Boosting Services safe?',
                'answer' => 'Without any doubt, Eloking is one of the best services to use for boosting. Feel free to read public reviews on Trustpilot.',
                'categories' => 'Eloking',
            ],
            [
                'question' => 'What are the prices of boosting services in Eloking?',
                'answer' => 'To get an exact price, please open the boost price calculator for your game or start placing a new order.',
                'categories' => 'Eloking',
            ],
            [
                'question' => 'I have a special order request, do you provide that?',
                'answer' => 'Most likely. We do take special orders but they need to be confirmed by our boosters. You can always contact live chat and describe what kind of custom order or request do you need, then, we will create and calculate the price for you.',
                'categories' => 'Eloking',
            ],
            [
                'question' => 'What happens if my account got banned?',
                'answer' => 'Even though we have never experienced such cases, you can always contact the live chat and if proven that the account was banned for boosting services, you will then be offered compensation.',
                'categories' => 'Eloking',
            ],
            [
                'question' => 'I liked my Eloking booster, how can I tip him?',
                'answer' => 'Our boosters will always appreciate a tip from our clients and that would motivate them even more, you are able to tip them through the order details page.',
                'categories' => 'Eloking',
            ]
        ];

        foreach ($data as $item) {
            $item['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            DB::table('help_desk_faqs')->insert($item);
        }
    }
}
