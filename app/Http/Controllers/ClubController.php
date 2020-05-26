<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Club;
use App\Domain;
use App\UserClub;
use App\User;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::with('images')->get();

        $users = User::with('clubs')->find(Auth::user()->id);
        //dd($users);
        //$userclubs = Club::where()->get();
        //dd($clubs);

        return view('clubs.index', ['clubs' => $clubs, 'users' => $users]);
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
        $club = Club::with('images')->find($id);
        $domain = Domain::where('id', '=', $club->domain_id)->first();
        $userno = UserClub::where('club_id', '=', $id)->count();

        $advisor = UserClub::where('club_id', '=', $id)->where('position_id', '=', 5)->first();
        if ($advisor) {
            $advisordet = User::where('id', '=', $advisor->user_id)->first();
        }else {
            $advisordet = NULL;
        }

        $president = UserClub::where('club_id', '=', $id)->where('position_id', '=', 1)->first();
        if ($president) {
            $presidentdet = User::where('id', '=', $president->user_id)->first();
        }else {
            $presidentdet = NULL;
        }

        $vice = UserClub::where('club_id', '=', $id)->where('position_id', '=', 2)->first();
        if ($vice) {
            $vicedet = User::where('id', '=', $vice->user_id)->first();
        }else {
            $vicedet = NULL;
        }

        $secretary = UserClub::where('club_id', '=', $id)->where('position_id', '=', 3)->first();
        if ($secretary) {
            $secretarydet = User::where('id', '=', $secretary->user_id)->first();
        }else {
            $secretarydet = NULL;
        }

        $treasurer = UserClub::where('club_id', '=', $id)->where('position_id', '=', 4)->first();
        if ($treasurer) {
            $treasurerdet = User::where('id', '=', $treasurer->user_id)->first();
        }else {
            $treasurerdet = NULL;
        }

        $checkUser = UserClub::where('club_id', '=', $id)->where('user_id', '=', Auth::user()->id)->count();
        //dd($checkUser);

        return view('clubs.show', ['club' => $club, 'domain' => $domain, 'userno' => $userno, 'advisordet' => $advisordet, 'presidentdet' => $presidentdet, 'vicedet' => $vicedet, 'secretarydet' => $secretarydet, 'treasurerdet' => $treasurerdet, 'checkUser' => $checkUser]);
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
