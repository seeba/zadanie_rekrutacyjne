<?php

namespace App\Factories;

use App\Helpers\PESELHelper;
use App\Models\User;

class ProgrammerFactory implements UserFactoryInterface
{
    public function createFrom(array $data)
    {
        if (array_key_exists('from', $data)){
            $from = $data['from'];
        } else {
            $from = 'UI';
        }
        $dateFromPesel = PESELHelper::getDateOfBirth($data['pesel']);
        $is_active = false;
        $send_mail = false;
        if ($dateFromPesel['age'] > 17) {
            $is_active = true;     
            $send_mail = true;}
        $user = User::create([
            'email' => $data['email'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'pesel' => $data['pesel'],
            'from' => $from,
            'password' => bcrypt($data['password']),
            'is_active' => $is_active

        ]);

        if (array_key_exists('languages', $data)){

            $user->programingLanguages()->createMany($data['languages']);
        }

        return ['programmer' => $user, 'send_mail' => $send_mail];
    }
}