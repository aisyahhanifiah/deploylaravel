<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Club;
use App\Domain;
use App\UserEvent;
use App\UserClub;
use App\Level;
use App\Category;
use App\Position;
use App\Event;
use App\EventImage;

class CommitteeEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = DB::table('club_user')
        ->join('clubs', 'clubs.id', '=', 'club_user.club_id')
        ->join('positions', 'positions.id', '=', 'club_user.position_id')
        ->select('positions.*', 'clubs.*', 'positions.name as position_name', 'clubs.id as club_id1')
        ->where('club_user.position_id', '<', 6)
        ->where('club_user.user_id', Auth::user()->id)
        ->get();

        $events = Event::orderBy('start_date', 'DESC')->get();

        $userno = UserEvent::all();

        // $users = User::with('clubs')->find(Auth::user()->id);

        // $meetings = Meeting::orderBy('datetime', 'DESC')->get();

        // $userMeeting = UserMeeting::all();
       

        return view('committee.event.index', ['clubs' => $clubs, 'events' => $events, 'userno' => $userno]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all(['id', 'name']);
        $domains = Domain::all(['id', 'name']);
        $categories = Category::all(['id', 'name']);
        // $clubs = Club::with('users')->where()->whereHas('users', function($q) {
        //     $q->where('club_user.position_id', '<', 6);
        // })->get();
        $clubs = DB::table('club_user')
        ->join('clubs', 'clubs.id', '=', 'club_user.club_id')
        ->join('positions', 'positions.id', '=', 'club_user.position_id')
        ->select('positions.*', 'clubs.*', 'positions.name as position_name', 'clubs.id as club_id1')
        ->where('club_user.position_id', '<', 6)
        ->where('club_user.user_id', Auth::user()->id)
        ->get();

        return view('committee.event.create', ['levels' => $levels, 'domains' => $domains, 'categories' => $categories, 'clubs' => $clubs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $model)
    {
        $model->create($request->all());

        return redirect()->route('admin.event.index')->withStatus(__('Event successfully created.'));
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
    public function edit(Event $event)
    {
        $levels = Level::all(['id', 'name']);
        $domains = Domain::all(['id', 'name']);
        $categories = Category::all(['id', 'name']);
        $clubs = DB::table('club_user')
        ->join('clubs', 'clubs.id', '=', 'club_user.club_id')
        ->join('positions', 'positions.id', '=', 'club_user.position_id')
        ->select('positions.*', 'clubs.*', 'positions.name as position_name', 'clubs.id as club_id1')
        ->where('club_user.position_id', '<', 6)
        ->where('club_user.user_id', Auth::user()->id)
        ->get();

        $images = EventImage::where('event_id', $event->id)->get();

        return view('committee.event.edit', compact('event', 'levels', 'domains', 'categories', 'clubs', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->route('admin.event.index')->withStatus(__('Event successfully updated.'));
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
