<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Meeting;
use App\UserMeeting;
use App\User;
use DB;

class CommitteeMeetingMemberController extends Controller
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
    public function store(Request $request,  UserMeeting $model)
    {
        if (UserMeeting::where('user_id', Input::get('user_id'))->where('meeting_id', Input::get('meeting_id'))->exists()) {
            return redirect()->back()->with('statuswarning','User is already an attendee.');
        }
        else {
            $model->create($request->all());
            return redirect()->back()->withStatus(__('Attendee successfully added.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($meetingid)
    {
        $meetings = Meeting::with('users')->find($meetingid);
        
        $findCreate = UserMeeting::where('meeting_id', '=', $meetingid)->get();
        //dd($clubs);
        $users = User::get();

        $clubid = $meetings->club_id;

        $users = User::whereDoesntHave('meetings', function ($query) use ($meetingid) {
            $query->where('meeting_user.meeting_id', $meetingid);
        })->whereHas('clubs', function($q) use ($clubid) {
            $q->where('club_user.club_id', $clubid);
        })->get();

        return view('committee.meeting.member.index', ['meetings' => $meetings, 'meetingid' => $meetingid, 'users' => $users, 'findCreate' => $findCreate]);
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
        $meetingid = $request->input('meetingid');

        $aa=DB::table('meeting_user')->where('user_id', '=', $id)->where('meeting_id', '=', $meetingid)->delete();

        return redirect()->back()->withStatus(__('Attendee successfully removed.'));
    }
}
