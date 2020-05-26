<?php

namespace App\Http\Controllers;

use App\UserClub;
use App\Club;
use App\UserEvent;
use App\Event;
use App\UserMeeting;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $clubs = UserClub::with('users')->where('club_user.user_id', auth()->user()->id)->count();
        $events = UserEvent::with('users')->where('event_user.user_id', auth()->user()->id)->count();
        $meetings = UserMeeting::with('users')->where('meeting_user.user_id', auth()->user()->id)->count();
        $pending = UserClub::with('users')->where('club_user.user_id',auth()->user()->id)->where('club_user.stripe_charge_id', NULL)->count();
        $pending1 = UserEvent::with('users')->where('event_user.user_id',auth()->user()->id)->where('event_user.stripe_charge_id', NULL)->count();
        // dd($pending);
        $totalpending = $pending + $pending1;

        $allclubs = Club::withCount('users')->with('domains:id,name')->limit(10)->get();
        $allevents = Event::withCount('users')->with('domains:id,name')->limit(10)->get()->sortBy('start_date', true);
        // dd($allclubs);
        return view('dashboard', compact('clubs', 'events', 'meetings', 'totalpending', 'allclubs', 'allevents'));
    }
}
