<?php

namespace App\Console\Commands;

use App\Models\InputModel;
use App\Mail\RecordAdded;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Custom\DateDiffPesel;

class CliInput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:input {email} {pesel} {name} {surname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert new user do database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // email validation
        $validatorEmail = Validator::make([
            'email' => $this->argument('email')
        ], [
            'email' => ['required', 'email', 'max:100']
        ]);

        if ($validatorEmail->fails()) {
            $this->error('Email not correct');
            return 0;
        }

        // pesel validation
        $validatorPesel = Validator::make([
            'pesel' => $this->argument('pesel')
        ], [
            'pesel' => ['required', 'digits:11']
        ]);

        if ($validatorPesel->fails()) {
            $this->error('Pesel not correct');
            return 0;
        }

        // name validation
        $validatorName = Validator::make([
            'name' => $this->argument('name')
        ], [
            'name' => ['required', 'alpha_num', 'min:3', 'max:50']
        ]);

        if ($validatorName->fails()) {
            $this->error('Name not correct');
            return 0;
        }

        // surname validation
        $validatorSurname = Validator::make([
            'surname' => $this->argument('surname')
        ], [
            'surname' => ['required', 'alpha_num', 'min:3', 'max:50']
        ]);

        if ($validatorSurname->fails()) {
            $this->error('Surname not correct');
            return 0;
        }

        // checking if records exist
        if (InputModel::where('email', '=', $this->argument('email'))->first()) {
            $this->warn('Email exists');
            return 0;
        }

        if (InputModel::where('pesel', '=', $this->argument('pesel'))->first()) {
            $this->warn('Pesel exists');
            return 0;
        }

        $diff = new DateDiffPesel($this->argument('pesel'));
        $diff->calc();

        // create and save record via a Model
        $input = new InputModel();
        $input->email = $this->argument('email');
        $input->pesel = $this->argument('pesel');
        $input->name = $this->argument('name');
        $input->surname = $this->argument('surname');
        if ($diff->getYear() < 18) $input->active = 0;
        $input->source = 'cli';
        $input->save();

        // send email
        Mail::to($this->argument('email'))->send(new RecordAdded($this->argument('email')));

        $this->info('Record saved in database');
        return 0;
    }
}
