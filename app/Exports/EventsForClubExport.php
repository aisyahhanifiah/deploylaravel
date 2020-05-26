<?php

namespace App\Exports;

use App\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventsForClubExport implements FromCollection, WithHeadings, WithMapping
{
	private $clubid;

	public function __construct($clubid)
	{
		// $events = Event::withCount('users')->with('domains:id,name')->with('categories:id,name')->with('levels:id,name')->with('clubs:id,name')->where('club_id', $clubid)->get();
	    $this->clubid = $clubid;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $events = Event::withCount('users')->with('domains:id,name')->with('categories:id,name')->with('levels:id,name')->with('clubs:id,name')->where('club_id', $this->clubid)->get();
    	// dd($events);
        return $events;
    }

    /**
    * @var Event $events
    */
    public function map($events): array
    {
        return [
        	$events->id,
        	$events->name,
        	$events->description,
        	$events->start_date,
            $events->end_date,
            $events->venue,
            $events->clubs->name,
        	$events->levels->name,
        	$events->categories->name,
        	$events->domains->name,
        	$events->requirement,
        	$events->capacity,
        	$events->fees,
        	$events->stripe_connect_id,
        	$events->users_count,
        	$events->created_at,
            $events->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Description',
            'Start Date',
            'End Date',
            'Venue',
            'Club Name',
            'Level',
            'Category',
            'Domain',
            'Requirement',
            'Capacity',
            'Fees',
            'Stripe ID',
            'Total Members',
            'Created at',
            'Updated at',
        ];
    }
}
