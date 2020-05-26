<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Club;
use App\Domain;
use App\UserClub;
use App\Position;
use App\ClubImage;

class CommitteeClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userclub = UserClub::where('user_id', '=', Auth::user()->id)->where('position_id', '<', 6)->get();
        //dd($userclub);
        // $users = User::with('clubs')->find(Auth::user()->id);
        $userno = UserClub::all();
        //$clubs = Club::with('images')->where('')->get();

        $clubs = DB::table('club_user')
        ->join('clubs', 'clubs.id', '=', 'club_user.club_id')
        ->join('positions', 'positions.id', '=', 'club_user.position_id')
        ->select('positions.*', 'clubs.*', 'positions.name as position_name', 'clubs.id as club_id1')
        ->where('club_user.position_id', '<', 6)
        ->where('club_user.user_id', Auth::user()->id)
        ->get();



         return view('committee.club.index', ['clubs' => $clubs, 'userno' => $userno]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        $domains = Domain::all(['id', 'name']);

        $images = ClubImage::where('club_id', $club->id)->get();
        // dd($images);

        return view('committee.club.edit', compact('domains', 'club', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        $club->update($request->all());

        return redirect()->route('committee.club.index')->withStatus(__('Club successfully updated.'));
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
