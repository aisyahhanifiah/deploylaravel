<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


use DB;
use Auth;
use App\Club;
use App\UserClub;
use App\User;
use App\Position;

class CommitteeClubMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $clubs = Club::with('users')->find($id);
        
        $position = User::find(1)->position;

        return view('committee.club.member.index', ['clubs' => $clubs, 'id' => $id]);
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
    public function store(Request $request,  UserClub $model)
    {
        if (UserClub::where('user_id', Input::get('user_id'))->where('club_id', Input::get('club_id'))->exists()) {
            return redirect()->back()->with('statuswarning','User is already a member.');
        }
        else {
            $model->create($request->all());

            if ($request->position_id < 6) {
                if(User::where('user_id', Input::get('user_id'))->where('email', 'admin@clubhub.com')){
                }else{
                    DB::table('users')->where('id', Input::get('user_id'))->update(
                        ['roles' => 'committee']
                    );
                }
                
            }else {
                if(User::where('user_id', Input::get('user_id'))->where('roles', 'committee')->exists()){

                }else{
                    DB::table('users')->where('id', Input::get('user_id'))->update(
                        ['roles' => 'normal']
                    );
                }
            
            }

            return redirect()->back()->withStatus(__('Member successfully added.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($clubid)
    {
        $clubsname = Club::with('users','positions')->find($clubid);

        // $users = User::doesntHave('clubs')->get();
        $users = User::whereDoesntHave('clubs', function ($query) use ($clubid) {
            $query->where('club_user.club_id', $clubid);
        })->get();

        // $users = User::with('positions')->get();

        // dd($users1);

        $clubs = DB::table('club_user')
        ->join('users', 'users.id', '=', 'club_user.user_id')
        ->join('positions', 'positions.id', '=', 'club_user.position_id')
        ->select('positions.*', 'users.*', 'positions.name as position_name','users.name as user_name')
        ->where('club_id', $clubid)
        ->get();

        $findCreate = UserClub::where('club_id', '=', $clubid)->get();

        //dd($clubs);
        $positions = Position::all();

        return view('committee.club.member.index', ['clubs' => $clubs, 'clubid' => $clubid, 'users' => $users, 'clubsname' => $clubsname, 'positions' => $positions, 'findCreate' => $findCreate]);
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
        $clubid = $request->input('clubid');

        $aa=DB::table('club_user')->where('user_id', '=', $id)->where('club_id', '=', $clubid)->delete();

        if(UserClub::where('user_id', $id)->where('position_id', '<', 6)->exists()){

        }else{
            if(User::where('user_id', $id)->where('email', 'admin@clubhub.com')){
            }else{
                DB::table('users')->where('id', Input::get('user_id'))->update(
                    ['roles' => 'normal']
                );
            }
        }

        return redirect()->back()->withStatus(__('Member successfully deleted.'));
    }
}
