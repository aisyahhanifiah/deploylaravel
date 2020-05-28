<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Club;
use App\Domain;
use App\UserMeeting;
use App\Position;
use App\Meeting;

class CommitteeMeetingController extends Controller
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

        $meetings = Meeting::orderBy('datetime', 'DESC')->get();

        $userno = UserMeeting::all();

        // $users = User::with('clubs')->find(Auth::user()->id);

        // $meetings = Meeting::orderBy('datetime', 'DESC')->get();

        // $userMeeting = UserMeeting::all();
       

        return view('committee.meeting.index', ['clubs' => $clubs, 'meetings' => $meetings, 'userno' => $userno]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clubs = DB::table('club_user')
        ->join('clubs', 'clubs.id', '=', 'club_user.club_id')
        ->join('positions', 'positions.id', '=', 'club_user.position_id')
        ->select('positions.*', 'clubs.*', 'positions.name as position_name', 'clubs.id as club_id1')
        ->where('club_user.position_id', '<', 6)
        ->where('club_user.user_id', Auth::user()->id)
        ->get();

        return view('committee.meeting.create', ['clubs' => $clubs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Meeting $model)
    {
        $model->create($request->all());

        return redirect()->route('committee.meeting.index')->withStatus(__('Meeting successfully created.'));
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
    public function edit(Meeting $meeting)
    {
        $clubs = DB::table('club_user')
        ->join('clubs', 'clubs.id', '=', 'club_user.club_id')
        ->join('positions', 'positions.id', '=', 'club_user.position_id')
        ->select('positions.*', 'clubs.*', 'positions.name as position_name', 'clubs.id as club_id1')
        ->where('club_user.position_id', '<', 6)
        ->where('club_user.user_id', Auth::user()->id)
        ->get();

        return view('committee.meeting.edit', compact('meeting','clubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        $meeting->update($request->all());

        return redirect()->route('admin.meeting.index')->withStatus(__('Meeting successfully updated.'));
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
