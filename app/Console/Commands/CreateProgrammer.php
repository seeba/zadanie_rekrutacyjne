<?php

namespace App\Console\Commands;

use App\Factories\ProgrammerFactory;
use App\Helpers\PESELHelper;
use App\Mail\Hello;
use App\Validators\ProgrammerValidator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CreateProgrammer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'programmer:create {first_name} {last_name} {email} {pesel} {password} {--lang=*} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tworzenie konta programisty';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $data = $this->arguments();
        $data['from'] = 'CLI';
        $options = $this->options();

        foreach ($options['lang'] as $lang) {
            $languages[] =['name' => $lang];
        }
        $data['languages'] = $languages;

        $validator = ProgrammerValidator::validate($data);
        
        if ($validator->fails()) {
            $this->info('Walidacja nie powiodla się');
            foreach($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }
       
        $programmerFactory = new ProgrammerFactory();
        $programmer = $programmerFactory->createFrom($data);

        if ($programmer['send_mail']) Mail::to($programmer['programmer']->email)->send(new Hello($programmer['programmer']));
        

        $this->info("Programista ".$programmer['programmer']->first_name." został dodany");
        return 0;
    }
}
