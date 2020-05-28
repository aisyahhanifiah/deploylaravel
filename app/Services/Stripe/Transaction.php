<?php

namespace App\Services\Stripe;


use App\Club;
use App\Event;
use App\User;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Transfer;
use App\UserClub;
use App\UserEvent;

class Transaction
{
    public static function create(User $user, Club $club)
    {
        // Initial data.
        $amount = $club->fees;
        $payout = $amount * 1.0;
        Stripe::setApiKey(config('services.stripe.secret'));

        if (is_null($user->stripe_user_id)) {
        }else{
            // Create a Stripe charge from the customer purchase.
            $charge = Charge::create([
                'amount' => self::toStripeFormat($amount),
                'currency' => 'myr',
                'customer' => $user->stripe_user_id,
                'description' => $club->name
            ]);

            if (is_null($club->stripe_connect_id)) {
            // return redirect()->back()->withStatus(__('This club haven\'t registered their bank account yet. Payment will not make through. Please contact respective high committee of the club. '));
            }else{
            // Pay funds to seller, with platform fees extracted.
                Transfer::create([
                    'amount' => self::toStripeFormat($payout),
                    "currency" => "myr",
                    "source_transaction" => $charge->id,
                    'destination' => $club->stripe_connect_id
                ]);

        // Save transaction to database.

                $updateDetails = [
                    'stripe_charge_id' => $charge->id,
                    'paid_out' => $payout,
                    'fees_collected' => $amount - $payout,
                    'updated_at' => now()
                ];

                if (UserClub::where('user_id', $user->id)->where('club_id', $club->id)->exists()) {
                    UserClub::where('user_id', $user->id)->where('club_id', $club->id)->update($updateDetails);

                }
                else {
                    
                    return redirect()->back()->withStatus(__('No member exist.'));
                }
            }
        }

        


    }

    public static function create1(User $user, Event $event)
    {
        // Initial data.
        $amount = $event->fees;
        $payout = $amount * 1.0;
        Stripe::setApiKey(config('services.stripe.secret'));

        if (is_null($user->stripe_user_id)) {
            
        }else{

            // Create a Stripe charge from the customer purchase.
            $charge = Charge::create([
                'amount' => self::toStripeFormat($amount),
                'currency' => 'myr',
                'customer' => $user->stripe_user_id,
                'description' => $event->name
            ]);

            if (is_null($event->stripe_connect_id)) {
                // return redirect()->back()->withStatus(__('This club haven\'t registered their bank account yet. Payment will not make through. Please contact respective high committee of the club. '));
            }else {
                // Pay funds to seller, with platform fees extracted.
                Transfer::create([
                    'amount' => self::toStripeFormat($payout),
                    "currency" => "myr",
                    "source_transaction" => $charge->id,
                    'destination' => $event->stripe_connect_id
                ]);

                // Save transaction to database.

                $updateDetails = [
                    'stripe_charge_id' => $charge->id,
                    'paid_out' => $payout,
                    'fees_collected' => $amount - $payout
                ];

                if (UserEvent::where('user_id', $user->id)->where('event_id', $event->id)->exists()) {
                    UserEvent::where('user_id', $user->id)->where('event_id', $event->id)->update($updateDetails);

                }
                else {

                    return redirect()->back()->withStatus(__('No member exist.'));
                }
                
            }
        }

        


    }

    public static function toStripeFormat(float $amount)
    {
        return $amount * 100;
    }
}

?>