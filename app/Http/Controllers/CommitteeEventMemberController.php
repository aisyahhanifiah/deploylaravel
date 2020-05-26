<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\UserEvent;
use App\User;

class CommitteeEventMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($eventid)
    {
        $events = Event::with('users')->find($eventid);
        
        $findCreate = UserEvent::where('event_id', '=', $eventid)->get();
        //dd($clubs);
        $users = User::whereDoesntHave('events', function ($query) use ($eventid) {
            $query->where('event_user.event_id', $eventid);
        })->get();

        return view('committee.event.member.index', ['events' => $events, 'eventid' => $eventid, 'users' => $users, 'findCreate' => $findCreate]);
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
    public function destroy(Request $request, $id)
    {
        $eventid = $request->input('eventid');

        $aa=DB::table('event_user')->where('user_id', '=', $id)->where('event_id', '=', $eventid)->delete();

        return redirect()->back()->withStatus(__('Participants successfully removed.'));
    }
}
