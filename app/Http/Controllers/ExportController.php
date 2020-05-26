<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\ClubsExport;
use App\Exports\EventsExport;
use App\Exports\UsersExport;
use App\Exports\EventsForClubExport;
use App\Exports\MeetingsForClubExport;
use App\Exports\MembersForClubExport;
use App\Exports\MembersForEventExport;
use App\Exports\MembersForMeetingExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

use App\Club;
use App\Event;
use App\Meeting;

class ExportController extends Controller
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportClub() 
    {
        return Excel::download(new ClubsExport, 'club_report_'. Carbon::now()->format('Y-m-d_His').'.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportEvent() 
    {
        return Excel::download(new EventsExport, 'event_report_'. Carbon::now()->format('Y-m-d_His').'.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportUser() 
    {
        return Excel::download(new UsersExport, 'user_report_'. Carbon::now()->format('Y-m-d_His').'.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportEventForClub($clubid) 
    {
        // dd($clubid);
        $club = Club::find($clubid);
        // dd($events);
        return Excel::download(new EventsForClubExport($clubid), 'event_report_'.$club->name.'_'. Carbon::now()->format('Y-m-d_His').'.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportMeetingForClub($clubid) 
    {
        // dd($clubid);
        $club = Club::find($clubid);
        // dd($events);
        return Excel::download(new MeetingsForClubExport($clubid), 'meeting_report_'.$club->name.'_'. Carbon::now()->format('Y-m-d_His').'.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportMemberForClub($clubid) 
    {
        // dd($clubid);
        $club = Club::find($clubid);
        // dd($events);
        return Excel::download(new MembersForClubExport($clubid), 'members_report_'.$club->name.'_'. Carbon::now()->format('Y-m-d_His').'.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportMemberForEvent($eventid) 
    {
        // dd($clubid);
        $event = Event::find($eventid);
        // dd($events);
        return Excel::download(new MembersForEventExport($eventid), 'participants_report_'.$event->name.'_'. Carbon::now()->format('Y-m-d_His').'.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportMemberForMeeting($meetingid) 
    {
        // dd($clubid);
        $meeting = Meeting::find($meetingid);
        // dd($events);
        return Excel::download(new MembersForMeetingExport($meetingid), 'attendees_report_'.$meeting->name.'_'. Carbon::now()->format('Y-m-d_His').'.xlsx');
    }

    
}

