<?php

namespace App\Services;

use App\Models\User;

class MembershipService
{
    public const PREFIX = 'CLAN-';

    public function generate() 
    {
        // select member_id from users oreder by id limit 1
        $lastUserMemberId = User::orderBy('id', 'desc')->first()->member_id; 

        if (str_contains($lastUserMemberId, self::PREFIX)) {
            $number = str_replace(self::PREFIX, '', $lastUserMemberId);
        }else {
            $number = 1;
        }

        return self::PREFIX . ++$number;
    }
}