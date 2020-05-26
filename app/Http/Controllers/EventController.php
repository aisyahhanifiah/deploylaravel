<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Club;
use App\Domain;
use App\Level;
use App\Category;
use App\UserEvent;
use App\User;

use Carbon\Carbon;

use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('images')->get()->sortBy('start_date', true);
        //dd($clubs);
        $users = User::with('events')->find(Auth::user()->id);

        return view('events.index', ['events' => $events, 'users' => $users]);
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
        $event = Event::with('images')->find($id);
        $domain = Domain::where('id', '=', $event->domain_id)->first();
        $level = Level::where('id', '=', $event->level_id)->first();
        $category = Category::where('id', '=', $event->category_id)->first();
        $club = Club::where('id', '=', $event->club_id)->first();

        $userno = UserEvent::where('event_id', '=', $id)->count();

        $checkUser = UserEvent::where('event_id', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
        //dd($checkUser);

        return view('events.show', ['event' => $event, 'domain' => $domain, 'userno' => $userno, 'checkUser' => $checkUser, 'level' => $level, 'category' => $category, 'club' => $club]);
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
