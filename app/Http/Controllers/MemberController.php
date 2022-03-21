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
}
