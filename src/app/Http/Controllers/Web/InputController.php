<?php

namespace App\Http\Controllers\Web;

use App\Models\InputModel;
use App\Mail\RecordAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Custom\DateDiffPesel;

class InputController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:100',
            'pesel' => 'required|digits:11',
            'name' => 'required|alpha_num|min:3|max:50',
            'surname' => 'required|alpha_num|min:3|max:50',
        ]);

        if (InputModel::where('email', '=', $request->email)->first())
            return redirect('/')->with('message', 'Email exists');

        if (InputModel::where('pesel', '=', $request->pesel)->first())
            return redirect('/')->with('message', 'PESEL exists');

        $diff = new DateDiffPesel($request->pesel);
        $diff->calc();

        $input = new InputModel();
        $input->email = $request->email;
        $input->pesel = $request->pesel;
        $input->name = $request->name;
        $input->surname = $request->surname;
        if ($diff->getYear() < 18) $input->active = 0;
        $input->source = 'ui';
        $input->save();

        Mail::to($request->email)->send(new RecordAdded($request->email));

        return redirect('/')->with('message', 'Success');
    }
}
