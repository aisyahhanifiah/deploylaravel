<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Club;
use App\Event;
use App\UserEvent;
use App\UserClub;
use App\User;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userclub = UserClub::with('clubs')->whereNull('stripe_charge_id')->where('user_id',Auth::user()->id)->get();
        // $club = Club::all();

        // $clubs = Club::whereHas('users', function($q) {
        //     $q->whereNull('club_user.stripe_charge_id');
        //     $q->where('club_user.user_id', Auth::user()->id);
        // })->with('users')->get();

        $pending = User::with('stripenull')->find(Auth::user()->id);
        
        $completed = User::with('stripeexist')->find(Auth::user()->id);

        $pending1 = User::with('stripenulleve')->find(Auth::user()->id);
        
        $completed1 = User::with('stripeexisteve')->find(Auth::user()->id);

        $userclub = UserClub::all();
        $userevent = UserEvent::all();
        // dd($users);

        return view('payment.index', ['pending' => $pending, 'completed' => $completed, 'pending1' => $pending1, 'completed1' => $completed1, 'userclub' => $userclub, 'userevent' => $userevent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
        $userclub = NULL;
        $userevent = NULL;
        if(UserClub::find($id))
        {
            $userclub = UserClub::find($id);
        }
        elseif (UserEvent::find($id)) {
            $userevent = UserEvent::find($id);
        }
     

        return view('payment.show', ['userclub' => $userclub, 'userevent' => $userevent]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1($id)
    {
        $userevent = NULL;
        $userclub = UserClub::find($id);
        $club = Club::where('id', $userclub->club_id)->first();

        return view('payment.show1', ['userclub' => $userclub, 'userevent' => $userevent, 'club' => $club]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show2($id)
    {
        $userclub = NULL;
        $userevent = UserEvent::find($id);
        $event = Event::where('id', $userevent->event_id)->first();

        return view('payment.show2', ['userevent' => $userevent, 'userclub' => $userclub, 'event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function printReceiptClub($id)
    {
        $userevent = NULL;
        // UserClub::with('users')->with('positions:id,name')->with('clubs:id,name')->where('club_user.club_id', $this->clubid)->get();

        $userclub = UserClub::with('users')->with('clubs:id,name,fees')->find($id);
        // dd($userclub);
        // $club = Club::with('users')->where('id', $userclub->club_id)->first();
        //get treasurer
        $treasurer = UserClub::with('users')->with('positions:id,name')->with('clubs:id,name,fees')->where('club_user.club_id', $userclub->club_id)->where('club_user.position_id', 4)->first();
        // dd($treasurer);

        $customer = new Buyer([
            'name'          => $userclub->users->name,
            'phone'         => $userclub->users->phone_no,
            'custom_fields' => [
                'email' => $userclub->users->email,
            ],
        ]);

        $client = new Party([
            'name'          => $userclub->clubs->name,
            'phone'         => $treasurer->users->phone_no,
            'custom_fields' => [
                'email'        => $treasurer->users->email,
            ],
        ]);

        $item = (new InvoiceItem())->title('Fees for '.$userclub->clubs->name)->pricePerUnit($userclub->clubs->fees);

        $invoice = Invoice::make('receipt')

            ->buyer($customer)
            ->seller($client)
            ->addItem($item)
            ->series($userclub->stripe_charge_id)
            ->date($userclub->updated_at)
            ->dateFormat('d M Y')
            ->currencySymbol('MYR')
            ->currencyCode('Ringgit Malaysia');

        return $invoice->download();

    }

    public function printReceiptEvent($id)
    {
        // $userevent = NULL;
        // UserClub::with('users')->with('positions:id,name')->with('clubs:id,name')->where('club_user.club_id', $this->clubid)->get();

        $userevent = UserEvent::with('users')->with('events:id,name,fees,club_id')->find($id);
        // dd($userclub);
        // $club = Club::with('users')->where('id', $userclub->club_id)->first();
        //get treasurer
        $treasurer = UserClub::with('users')->with('positions:id,name')->with('clubs:id,name,fees')->where('club_user.club_id', $userevent->events->club_id)->where('club_user.position_id', 4)->first();


        // dd($treasurer);

        $customer = new Buyer([
            'name'          => $userevent->users->name,
            'phone'         => $userevent->users->phone_no,
            'custom_fields' => [
                'email' => $userevent->users->email,
            ],
        ]);

        $client = new Party([
            'name'          => $userevent->events->name,
            'phone'         => $treasurer->users->phone_no,
            'custom_fields' => [
                'email'        => $treasurer->users->email,
            ],
        ]);

        $item = (new InvoiceItem())->title('Fees for '.$userevent->events->name)->pricePerUnit($userevent->events->fees);

        $invoice = Invoice::make('receipt')

            ->buyer($customer)
            ->seller($client)
            ->addItem($item)
            ->series($userevent->stripe_charge_id)
            ->date($userevent->updated_at)
            ->dateFormat('d M Y')
            ->currencySymbol('MYR')
            ->currencyCode('Ringgit Malaysia')
            ->currencyFraction('cents');

        return $invoice->download();

    }
}
