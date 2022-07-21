<?php

namespace App\Console\Commands;

use App\Helpers\PESELHelper;
use App\Mail\Activate;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ActivateAdultProgrammers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'programmer:adult:activate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aktywacja kont użytkowników powyżej 18 lat';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $noActiveProgrammers = User::noActive()->get();
        
        $i = 0;
        $now = Carbon::today();
        if ($noActiveProgrammers->count() > 0) {
             foreach ($noActiveProgrammers as $noActiveProgrammer)
            {
                $dateFromPesel = PESELHelper::getDateOfBirth($noActiveProgrammer->pesel);
                if ($dateFromPesel['age'] > 17){
                    $i++;
                    $noActiveProgrammer->is_active = true;
                    $noActiveProgrammer->save();
                    if ($dateFromPesel['date']->diffInDays($now) == 0){
                        Mail::to($noActiveProgrammer->email)->send(new Activate($noActiveProgrammer));
                    }
                }
            }
        }
       
        $this->info('Aktywowano konta '.$i.' użytkownikom');
        return 0;
    }
}
