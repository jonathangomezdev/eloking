<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmissionMail;
use App\Order;
use App\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Show home page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $title = 'Leading ELO Boost Platform';

        session()->forget('game.visited');
        return view('home', [
            'title' => $title,
            'meta_description' => config('seo_meta.description.home'),
        ]);
    }

    /**
     * Show csgo page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function csgo()
    {
        $title = 'Hire CS:GO Boosters';
        session()->put('game.visited', 'csgo');

        return view('csgo.home', [
            'title' => $title,
            'orderSummary' => Order::getOrderSummary('csgo'),
            'meta_description' => config('seo_meta.description.csgo-home'),
        ]);
    }

    /**
     * Show csgo rank page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function csgoRank()
    {
        $title = 'Buy CS:GO Rank Boosting';
        $ranks = Rank::list('csgo');

        return view('csgo.rank', [
            'title' => $title,
            'ranks' => $ranks,
            'orderSummary' => Order::getOrderSummary('csgo'),
            'meta_description' => config('seo_meta.description.csgo-rank-boost'),
        ]);
    }

    /**
     * ESEA boost page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function csgoEsea()
    {
        $title = 'ESEA Rank Boosting';
        $ranks = Rank::list('csgo');

        return view('csgo.esea', [
            'title' => $title,
            'ranks' => $ranks,
            'orderSummary' => Order::getOrderSummary('csgo', 'esea'),
            'meta_description' => config('seo_meta.description.csgo-esea-boost'),
        ]);
    }

    /**
     * Faceit boost page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function csgoFaceit()
    {
        $title = 'Faceit Boost Service';
        $ranks = Rank::list('csgo');

        return view('csgo.faceit', [
            'title' => $title,
            'ranks' => $ranks,
            'orderSummary' => Order::getOrderSummary('csgo', 'faceit'),
            'meta_description' => config('seo_meta.description.csgo-faceit-boost'),
        ]);
    }

    /**
     * Valorant page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function valorant()
    {
        $title = 'Buy Valorant Boost - Premium Rank Boosting';
        $ranks = Rank::list('valorant');

        session()->put('game.visited', 'valorant');

        return view('valorant.rank', [
            'title' => $title,
            'ranks' => $ranks,
            'orderSummary' => Order::getOrderSummary('valorant'),
            'meta_description' => config('seo_meta.description.valorant-boost'),
        ]);
    }

    /**
     * League of Legends page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lol()
    {
        $title = 'Buy LOL Boost - Premium ELO Boosting for League';
        $ranks = Rank::list('lol');

        session()->put('game.visited', 'lol');

        return view('lol.rank', [
            'title' => $title,
            'ranks' => $ranks,
            'orderSummary' => Order::getOrderSummary('lol'),
            'meta_description' => config('seo_meta.description.lol-boost'),
        ]);
    }

    /**
     * Show about us page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        $title = 'About Eloking';
        return view('static.about', [
            'title' => $title,
            'meta_description' => config('seo_meta.description.about'),
        ]);
    }

    /**
     * Show jobs page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobs()
    {
        $title = 'Boosting Jobs at Eloking';

        return view('static.jobs', [
            'title' => $title,
            'meta_description' => config('seo_meta.description.jobs'),
        ]);
    }

    /**
     * Show privacy policy page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacyPolicy()
    {
        $title = 'Privacy Policy';

        return view('static.privacy-policy', ['title' => $title]);
    }

    /**
     * Show terms for players page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function termsForPlayers()
    {
        $title = 'Terms and Conditions for Players';

        return view('static.tos-players', ['title' => $title]);
    }

    /**
     * Show terms for users page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function termsForUsers()
    {
        $title = 'Terms and Conditions for Users';

        return view('static.tos-users', ['title' => $title]);
    }

    /**
     * Shows contact us page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function contact()
    {
        $title = 'Contact us';

        return view('static.contact', [
            'title' => $title,
            'meta_description' => config('seo_meta.description.contact'),
        ]);
    }

    /**
     * This is responsible to trigger when contact us form is submitted
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleSubmittedForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string|min:2',
            'discord' => 'nullable',
            'rank' => 'nullable',
            'boost_exp' => 'nullable',
            'account_link' => 'nullable',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $to = $request->email;

        if ($request->discord) {
            $to = config('eloking.contact_form_submission_receiver_email');
        }

        $mail = Mail::to([$to]);

        if (! $request->discord) {
            $mail->bcc(config('eloking.contact_form_submission_receiver_email'));
        }

        $mail->send(new ContactFormSubmissionMail($request->name, $request->email, $request->message, $request->discord, $request->rank, $request->boost_exp, $request->account_link));

        session()->flash('success', 'Contact form successfully submitted');
        return redirect()->back();
    }
}
