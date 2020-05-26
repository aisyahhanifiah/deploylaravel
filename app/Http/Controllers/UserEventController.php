<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Event;
use App\UserEvent;
use App\User;

use App\Services\Stripe\Transaction;

use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
class UserEventController extends Controller
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
        $user = Auth::user();
        $event = Event::find($request->eventid);

        Transaction::create1($user, $event);

        if (is_null($user->stripe_user_id)) {
            return back()->with('warning', sprintf('You haven\'t register your bank card yet. Please go to edit profile and add your bank card to make payment.', $event->name));
        }else{
            if (is_null($event->stripe_connect_id)) {
                return back()->with('warning', sprintf('This club haven\'t registered their bank account yet. Payment will not make through. Please contact respective high committee of the club. ', $event->name));
            }
            return back()->with('success', sprintf('You have paid fees', $event->name));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('events')->find(Auth::user()->id);
        // dd($users);

        //dd($users);

        $userno = UserEvent::all();

        // $meetings = Meeting::orderBy('datetime', 'DESC')->get();

        // $userMeeting = UserMeeting::all();
        //dd($userMeeting);

        //$checkUser = UserClub::where('club_id', '=', $id)->where('user_id', '=', Auth::user()->id)->count();

        //usermeet/totalmeet*100
        // $totalMeet = $meetings->where('club_id', '=', $club->id)->count();
        // $meet = $meetings->where('club_id', '=', $club->id)->get();
        // $userMeet = $userMeeting->where('meeting_id', '=', $meet->id)->count();

        return view('participation.index', ['users' => $users, 'userno' => $userno]);
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

    public function join(Request $request, UserEvent $model)
    {
        $model->create($request->all());

        return redirect()->back()->withStatus(__('You have successfully joined the event.'));
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
