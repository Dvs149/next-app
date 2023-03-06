<?php

namespace App\Exports\admin\eport;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // return User::all();
        $type = User::select('id','name','email','mobile','type_of_account')
                    ->get()
                    ->makeHidden(['u_id','profile_photo_url','profile_url','reward_type','cover_photo_url']);
        return $type ;
    }
    public function headings(): array
    {
        return [
            'name','email','mobile','type of account'
        ];
    }
}
