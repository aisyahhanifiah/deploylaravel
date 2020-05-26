<?php

namespace App\Exports;

use App\Club;
use App\User;
use App\UserClub;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class MembersForClubExport implements FromCollection, WithHeadings, WithMapping
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
    	$clubs = UserClub::with('users')->with('positions:id,name')->with('clubs:id,name')->where('club_user.club_id', $this->clubid)->get();
    	// dd($clubs);
        return $clubs;
    }

    /**
    * @var Club $clubs
    */
    public function map($clubs): array
    {
        return [
        	$clubs->users->id,
        	$clubs->users->name,
        	$clubs->users->email,
        	$clubs->users->unikl_id,
        	$clubs->users->phone_no,
        	$clubs->users->gender,
        	$clubs->users->dob,
        	$clubs->positions->name,
        	$clubs->stripe_charge_id,
        	$clubs->users->stripe_card,
        	$clubs->users->stripe_type,
        	$clubs->created_at,
            $clubs->updated_at,
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
            'Position',
            'Payment',
            'Card ending',
            'Card Type',
            'Created at',
            'Updated at',
        ];
    }
}
