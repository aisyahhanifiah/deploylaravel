<?php

namespace App\Exports;

use App\Club;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClubsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$clubs = Club::withCount('users')->with('domains:id,name')->get();

        return $clubs;
    }

    /**
    * @var Club $clubs
    */
    public function map($clubs): array
    {
        return [
        	$clubs->id,
        	$clubs->name,
        	$clubs->semester,
        	$clubs->description,
        	$clubs->domains->name,
        	$clubs->requirement,
        	$clubs->capacity,
        	$clubs->fees,
        	$clubs->url_fb,
        	$clubs->url_ig,
        	$clubs->url_email,
        	$clubs->stripe_connect_id,
        	$clubs->users_count,
        	$clubs->created_at,
            $clubs->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Semester',
            'Description',
            'Domain',
            'Requirement',
            'Capacity',
            'Fees',
            'FB Link',
            'IG Link',
            'Official Email',
            'Stripe ID',
            'Total Members',
            'Created at',
            'Updated at',
        ];
    }
}
