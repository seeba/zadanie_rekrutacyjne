<?php

namespace App\Http\Controllers;

use App\Factories\ProgrammerFactory;
use App\Helpers\PESELHelper;
use App\Http\Requests\CreateProgrammer;
use App\Mail\Hello;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class ProgrammerController extends Controller
{
    public function index($days)
    {
        Gate::authorize('admin-level');
        $users = User::createdAt($days)->paginate(15);
        $programmers = [];
        foreach($users as $user) {
            $programmer['left'] = $this->dateHelper($user->pesel)['left'];
            $programmer['age'] = $this->dateHelper($user->pesel)['age'];
            $programmer['first_name'] = $user->first_name;
            $programmer['last_name'] = $user->last_name;
            $programmer['from'] = $user->from;
            $programmer['email'] = $user->email;


            $programmers[] = $programmer;
        }
       
       return view('programmer.index', ['programmers' => $programmers]); 
    }

    public function create()
    {
        Gate::authorize('admin-level');
        return view('programmer.create');

    }

    public function store(CreateProgrammer $request)
    {
        $data = $request->all();
        $langs = $data['langs'];
        $languages = [];
        foreach($langs as $lang){
            $languages[] = ['name' => $lang];
        } 
        $data['languages'] = $languages;
        $programerFactory = new ProgrammerFactory();
        $programmer = $programerFactory->createFrom($data);
        if ($programmer['send_mail']) Mail::to($programmer['programmer']->email)->send(new Hello($programmer['programmer']));

        return redirect()->route('programmer.index');

    }

    private function dateHelper($pesel)
    {
        $dateFromPesel = PESELHelper::getDateOfBirth($pesel);
           
            if ($dateFromPesel['age'] < 18) {
                $now = Carbon::now();
                $date = $dateFromPesel['date'];
                
                $date3 = $date->addYears(18);
                $years_total = $now->diff($date3)->y;
                $days_excluding_years = ($now->diff($date3)->days);
                
                return [
                    'left' => $years_total.' lat '.$days_excluding_years. "dni",
                    'age' => $dateFromPesel['age']
                ];
                
            } return [
                'left' => '',
                'age' => $dateFromPesel['age']
            ];
    }
}
