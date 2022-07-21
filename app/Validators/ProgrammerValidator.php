<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class ProgrammerValidator 
{
    public static function validate(array $data)
    {
        $validator = Validator::make($data,[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'pesel' => 'PESEL|required|unique:users,pesel',
            'languages.*.name' => 'distinct'
         ], [
            'first_name.required' => 'Imię jest wymagane',
            'last_name.required' => 'Nazwisko jest wymagane',
            'email.required' => 'Email jest wymagany',
            'email.email' => 'Wpisz poprawny email',
            'pesel.PESEL' => 'PESEL nie jest poprawny',
            'pesel.required' => 'PESEL jest wymagany',
            'pesel.unique' => 'Istnieje użytkownik w bazie z takim nr PESEL',
            'languages.*.name.distinct' => 'Nie można wpisać dwóch takich samych języków programowania'


         ]);

         return $validator;
    }
}