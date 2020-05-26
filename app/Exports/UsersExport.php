<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    /**
    * @var Club $users
    */
    public function map($users): array
    {
        return [
        	$users->id,
        	$users->name,
        	$users->email,
        	$users->unikl_id,
        	$users->phone_no,
        	$users->gender,
        	$users->dob,
        	$users->roles,
        	$users->stripe_user_id,
        	$users->stripe_card,
        	$users->stripe_type,
        	$users->created_at,
            $users->updated_at,
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
            'Roles',
            'Stripe ID',
            'Card ending',
            'Card Type',
            'Created at',
            'Updated at',
        ];
    }
}
