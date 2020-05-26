<?php

namespace App\Exports;

use App\Event;
use App\UserEvent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class MembersForEventExport implements FromCollection, WithHeadings, WithMapping
{
	private $eventid;

	public function __construct($eventid)
	{
	    $this->eventid = $eventid;
	}

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $events = UserEvent::with('users')->where('event_user.event_id', $this->eventid)->get();
    	// dd($events);
        return $events;
    }

    /**
    * @var Event $events
    */
    public function map($events): array
    {
        return [
        	$events->users->id,
        	$events->users->name,
        	$events->users->email,
        	$events->users->unikl_id,
        	$events->users->phone_no,
        	$events->users->gender,
        	$events->users->dob,
        	$events->stripe_charge_id,
        	$events->users->stripe_card,
        	$events->users->stripe_type,
        	$events->created_at,
            $events->updated_at,
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
            'Payment',
            'Card ending',
            'Card Type',
            'Created at',
            'Updated at',
        ];
    }
}
