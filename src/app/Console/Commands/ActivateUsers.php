<?php

namespace App\Console\Commands;

use App\Models\InputModel;
use App\Mail\UserActivated;
use App\Custom\DateDiffPesel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ActivateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activate:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate users above age 18';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nonActiveAdultUsers = InputModel::where('active', 0)->get()->map(function($item) {
            $diff = new DateDiffPesel($item->pesel);
            $diff->calc();

            if ($diff->getYear() >= 18) return $item;
        });

        if ($nonActiveAdultUsers->contains(null)) {
            $this->line('No users to activate');
            return 0;
        }
        
        foreach ($nonActiveAdultUsers as $user) {
            $user->active = 1;
            $user->save();

            Mail::to($user->email)->send(new UserActivated($user->email));

            $this->line('User: ' . $user->email . ' activated');
        }

        return 0;
    }
}
