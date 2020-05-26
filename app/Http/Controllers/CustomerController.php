<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\Stripe\Customer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Stripe\Token;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function form()
    {
        return view('stripe.form');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cc_number' => 'required',
            'month' => 'required',
            'year' => 'required',
            'cvv' => 'required'
        ]);
        $card = [
            'card' => [
            'number' => $request->cc_number,
            'exp_month' => $request->month,
            'exp_year' => $request->year,
            'cvc' => $request->cvv
            ]
        ];
        /** @var User $user */
        $user = Auth::user();
        $output = substr($request->cc_number, -4);
        $type = NULL;
        // dd(substr($request->cc_number, -16,1));
        if(substr($request->cc_number, -16,1) == 4)
        {
            $type = 'Visa';
        }
        elseif(substr($request->cc_number, -16,1) == 5)
        {
            $type = 'Mastercard';
        }
        Auth::user()->update(['stripe_card' =>  $output, 'stripe_type' => $type]);
        Customer::save($user, $card);
        return redirect()->back()->withStatus('Card has been saved.');
    }
}
