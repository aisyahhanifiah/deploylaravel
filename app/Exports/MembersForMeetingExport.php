<?php

namespace App\Exports;

use App\Meeting;
use App\UserMeeting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class MembersForMeetingExport implements FromCollection, WithHeadings, WithMapping
{
	private $meetingid;

	public function __construct($meetingid)
	{
	    $this->meetingid = $meetingid;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $meetings = UserMeeting::with('users')->where('meeting_user.meeting_id', $this->meetingid)->get();
    	// dd($meetings);
        return $meetings;
    }

    /**
    * @var Meeting $meetings
    */
    public function map($meetings): array
    {
        return [
        	$meetings->users->id,
        	$meetings->users->name,
        	$meetings->users->email,
        	$meetings->users->unikl_id,
        	$meetings->users->phone_no,
        	$meetings->users->gender,
        	$meetings->users->dob,
        	$meetings->users->stripe_card,
        	$meetings->users->stripe_type,
        	$meetings->created_at,
            $meetings->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Unikl_id',
            'Phone_no',
            'Gender',
            'Dob',
            'Card ending',
            'Card Type',
            'Created at',
            'Updated at',
        ];
    }
}
