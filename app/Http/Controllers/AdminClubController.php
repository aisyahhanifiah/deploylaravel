<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Club;
use App\Domain;
use App\UserClub;
use App\User;
use App\ClubImage;

class AdminClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Club::with('images')->get();
        //dd($clubs);

        $user = User::all();

        $userno = UserClub::all();
        $no = 0;
        return view('admin.club.index', ['clubs' => $clubs, 'userno' => $userno, 'user' => $user, 'no' => $no]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $domains = Domain::all(['id', 'name']);

        return view('admin.club.create', ['domains' => $domains]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  Club $model)
    {
        $model->create($request->all());

        return redirect()->route('admin.club.index')->withStatus(__('Club successfully created.'));
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
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        $domains = Domain::all(['id', 'name']);
        $images = ClubImage::where('club_id', $club->id)->get();

        return view('admin.club.edit', compact('domains', 'club', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        $club->update($request->all());

        return redirect()->route('admin.club.index')->withStatus(__('Club successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        $club->delete();

        return redirect()->route('admin.club.index')->withStatus(__('Club successfully deleted.'));
    }
}
