<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EventImage;

use Storage;
use File;

class EventImageController extends Controller
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
    public function store(Request $request, EventImage $eventimage)
    {
        if(request()->hasFile('image')){
            $image       = $request->file('image');
            $filename    = $image->getClientOriginalName();


            $destinationPathImg = 'public/img/';
            Storage::disk('uploads')->put('event/'. $filename, File::get($image));

            $eventimage->create(['filename' => $filename, 'event_id' => $request->event_id]);

            return redirect()->back()->withStatus(__('Image successfully added.'));
        }
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
        
        $a = EventImage::find($id)->delete();

        return redirect()->back()->withStatus(__('Image successfully deleted.'));
    }
}
