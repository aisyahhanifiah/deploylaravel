<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Club;
use App\Event;
use App\UserClub;
use App\UserEvent;
use App\User;
use App\Meeting;
use App\UserMeeting;

use App\Services\Stripe\Transaction;

use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class UserClubController extends Controller
{

    /**
     * Purchase a product from a seller.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function purchase(Request $request)
    {
        // $this->validate($request, [
        //     'upc' => 'required'
        // ]);
        /** @var User $user */
        $user = Auth::user();
        /** @var Product $product */
        $club = Club::find($request->clubid);

        // if(is_null($product)){
        //     return back()->with('error', 'Product not found');
        // }
        // $event = Event::where('club_id', $club->id)->get();

        // foreach ($event as $event) {
        //     $userevent = UserEvent::find($event->id);
        //     $userevent->update
            
        // }cus_HJnGF7RHzASCzc

        //Create a Transaction.
        Transaction::create($user, $club);

        if (is_null($user->stripe_user_id)) {
            return back()->with('warning', sprintf('You haven\'t register your bank card yet. Please go to edit profile and add your bank card to make payment.', $club->name));
        }else{
            if (is_null($club->stripe_connect_id)) {
                return back()->with('warning', sprintf('This club haven\'t registered their bank account yet. Payment will not make through. Please contact respective high committee of the club. ', $club->name));
            }
            return back()->with('success', sprintf('You have paid fees', $club->name));

        }
        
        // return back()->with('success', sprintf('You have paid fees', $club->name));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('clubs')->find(Auth::user()->id);

        $meetings = Meeting::orderBy('datetime', 'DESC')->get();

        $userMeeting = UserMeeting::all();
        //dd($userMeeting);

        //$checkUser = UserClub::where('club_id', '=', $id)->where('user_id', '=', Auth::user()->id)->count();

        //usermeet/totalmeet*100
        // $totalMeet = $meetings->where('club_id', '=', $club->id)->count();
        // $meet = $meetings->where('club_id', '=', $club->id)->get();
        // $userMeet = $userMeeting->where('meeting_id', '=', $meet->id)->count();

        return view('userclubs.index', ['users' => $users, 'meetings' => $meetings, 'userMeeting' => $userMeeting]);
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


    public function join(Request $request, UserClub $model)
    {
        $model->create($request->all());

        return redirect()->back()->withStatus(__('You have successfully joined the club.'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
