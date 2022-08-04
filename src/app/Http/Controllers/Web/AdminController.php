<?php

namespace App\Http\Controllers\Web;

use App\Models\InputModel;
use App\Custom\DateDiffPesel;
use Illuminate\Http\Request;

class AdminController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $users = InputModel::all();
        $this->addAgeInfo($users);

        return view('admin', ['users' => $users]);
    }

    public function show($timeSpan)
    {
        $date = new \DateTime();
        $date->modify('-' . (int)$timeSpan . ' day');

        $users = InputModel::where('created_at', '>', $date->format('Y-m-d H:i:s'))->get();
        $this->addAgeInfo($users);

        return view('admin', ['users' => $users]);
    }

    private function addAgeInfo(&$users)
    {
        foreach ($users as $key => $user) {
            $diff = new DateDiffPesel($user->pesel);
            $diff->calc();

            $users[$key]->age = $diff->getYear() < 18 ? $diff->adultTimeLeft() : $diff->getYear();
        }
    }
}
