<?php

namespace App\Exports;

use App\Meeting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class MeetingsForClubExport implements FromCollection, WithHeadings, WithMapping
{
	private $clubid;

	public function __construct($clubid)
	{
	    $this->clubid = $clubid;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $meetings = Meeting::withCount('users')->with('clubs:id,name')->where('club_id', $this->clubid)->get();
    	// dd($meetings);
        return $meetings;
    }

    /**
    * @var Meeting $meetings
    */
    public function map($meetings): array
    {
        return [
        	$meetings->id,
        	$meetings->name,
        	$meetings->datetime,
            $meetings->venue,
            $meetings->clubs->name,
            $meetings->users_count,
        	$meetings->created_at,
            $meetings->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Date and Time',
            'Venue',
            'Club Name',
            'Total Attendees',
            'Created at',
            'Updated at',
        ];
    }
}
