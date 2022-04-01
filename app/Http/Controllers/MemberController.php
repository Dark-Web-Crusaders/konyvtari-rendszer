<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MemberController extends Controller
{
    public function Members()
    {
        $members = DB::table("members")->paginate(20);
        return view("members", compact('members'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'min:4'],
            'birthdate' => ['required', 'after:1900-01-01'],
            'address' => ['required', 'regex:'],
            'email' => ['required'],
            'pin' => ['required'],
            'role' => ['']
        ]);

        dd($request);

    }
}
