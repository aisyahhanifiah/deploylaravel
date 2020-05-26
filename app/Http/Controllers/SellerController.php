<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Stripe\Seller;
use App\Club;
use App\Event;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stripe\Account;
use Stripe\BitcoinTransaction;
use Stripe\Stripe;

class SellerController extends Controller
{
    /**
     * Redirect to Stripe To Create Account
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create($club)
    {
        //$user = Auth::user();
        $clubs = Club::find($club);
        if(!is_null($clubs->stripe_connect_id)){
            return redirect()->route('stripe.login', $club);
        }
        //$session = request()->session()->getId();
        $url = config('services.stripe.connect'). '&state='.$club;
        return redirect($url);
    }

    /**
     * Redirect To Stripe Connect Account.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function connect($club)
    {
        // $user = Auth::user();
        $clubs= Club::find($club);
        Stripe::setApiKey(config('services.stripe.secret'));
        $account_link = Account::createLoginLink($clubs->stripe_connect_id);
        return redirect($account_link->url);
    }

    /**
     * Save a Stripe Connect Account.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'scope' => 'required',
            'state' => 'required',
        ]);
        //$session = DB::table('sessions')->where('id', '=', $request->state)->first();
        $data = Seller::create($request->code);
        Club::find($request->state)->update(['stripe_connect_id' => $data->stripe_user_id]);

        $club = Club::find($request->state);
        $event = Event::where('club_id', $club->id)->get();

        foreach ($event as $event) {
            
            $event->update(['stripe_connect_id' => $data->stripe_user_id]);
            
        }
        return redirect()->back()->with('success', 'Account information has been saved.');
    }
}
