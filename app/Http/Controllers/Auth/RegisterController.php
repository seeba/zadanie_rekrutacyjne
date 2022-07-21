<?php

namespace App\Http\Controllers\Auth;

use App\Factories\ProgrammerFactory;
use App\Http\Controllers\Controller;
use App\Mail\Hello;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required'],
            'pesel' => ['required', 'PESEL'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'langs.*' => ['distinct', 'required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $langs = $data['langs'];
        $languages = [];
        foreach($langs as $lang){
            $languages[] = ['name' => $lang];
        } 
        $data['languages'] = $languages;
        $programmerFactory = new ProgrammerFactory();
        $programmer = $programmerFactory->createFrom($data);
        if ($programmer['send_mail']) Mail::to($programmer['programmer']->email)->send(new Hello($programmer['programmer']));

        
        return $programmer['programmer'];
    }
}
