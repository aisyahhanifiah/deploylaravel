<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Domain;
use App\UserEvent;
use App\User;
use App\Level;
use App\Category;
use App\Club;
use App\UserClub;
use App\EventImage;

use Auth;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('images')->get();
        //dd($clubs);


        $userno = UserEvent::all();
        $no = 0;

        return view('admin.event.index', ['events' => $events, 'userno' => $userno, 'no' => $no]);
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

        $userclub = UserClub::where('club_user.position_id', '<', 6)
        ->where('club_user.user_id', Auth::user()->id)
        ->pluck('club_id');

        // dd($userclub);

       $clubs = Club::whereHas('users', function($q) {
            $q->where('club_user.position_id', '<', 6);
        })
        ->get();

        // $clubs = Club::with('users')->withPivot('position_id')->where('club_user.position_id', '<', 6)->where('club_user.user_id','=', Auth::user()->id)->get();

        // dd($clubs);
        return view('admin.event.create', ['levels' => $levels, 'domains' => $domains, 'categories' => $categories, 'clubs' => $clubs, 'userclub' => $userclub]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $model
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
        $clubs = Club::whereHas('users', function($q) {
            $q->where('club_user.position_id', '<', 6);
        })
        ->get();

        $images = EventImage::where('event_id', $event->id)->get();

        return view('admin.event.edit', compact('event', 'levels', 'domains', 'categories', 'clubs', 'images'));
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
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.event.index')->withStatus(__('Event successfully deleted.'));
    }
}
