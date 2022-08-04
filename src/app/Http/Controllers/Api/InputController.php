<?php

namespace App\Http\Controllers\Api;

use App\Models\InputModel;
use App\Mail\RecordAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Custom\DateDiffPesel;

class InputController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        // email validation
        $validatorEmail = Validator::make([
            'email' => $request->email
        ], [
            'email' => ['required', 'email', 'max:100']
        ]);

        if ($validatorEmail->fails()) {
            return ['message' => 'Email not correct'];
        }

        // pesel validation
        $validatorPesel = Validator::make([
            'pesel' => $request->pesel
        ], [
            'pesel' => ['required', 'digits:11']
        ]);

        if ($validatorPesel->fails()) {
            return ['message' => 'Pesel not correct'];
        }

        // name validation
        $validatorName = Validator::make([
            'name' => $request->name
        ], [
            'name' => ['required', 'alpha_num', 'min:3', 'max:50']
        ]);

        if ($validatorName->fails()) {
            return ['message' => 'Name not correct'];
        }

        // surname validation
        $validatorSurname = Validator::make([
            'surname' => $request->surname
        ], [
            'surname' => ['required', 'alpha_num', 'min:3', 'max:50']
        ]);

        if ($validatorSurname->fails()) {
            return ['message' => 'Surname not correct'];
        }

        if (InputModel::where('email', '=', $request->email)->first())
            return ['message', 'Email exists'];

        if (InputModel::where('pesel', '=', $request->pesel)->first())
            return ['message', 'PESEL exists'];

        $diff = new DateDiffPesel($request->pesel);
        $diff->calc();

        $input = new InputModel();
        $input->email = $request->email;
        $input->pesel = $request->pesel;
        $input->name = $request->name;
        $input->surname = $request->surname;
        if ($diff->getYear() < 18) $input->active = 0;
        $input->source = 'api';
        $input->save();

        Mail::to($request->email)->send(new RecordAdded($request->email));

        return ['message' => 'success'];
    }
}
