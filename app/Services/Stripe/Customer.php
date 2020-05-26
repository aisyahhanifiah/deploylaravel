<?php

namespace App\Services\Stripe;


use App\User;
use Stripe\Stripe;
use Stripe\Token;

class Customer
{
    public static function save(User $user, array $card)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $token = Token::create($card);
        $customer = \Stripe\Customer::create([
            'source' => $token->id,
            'email' => $user->email
        ]);
        $user->update(['stripe_user_id' => $customer->id]);
        // $user->update(['stripe_card' => 'ffff']);
    }
}

?>