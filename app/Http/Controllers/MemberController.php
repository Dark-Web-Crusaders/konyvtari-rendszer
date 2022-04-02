<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Member;

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
            'address' => ['required', 'regex:^\d{4,5}+[. ,a-zA-Z]*+\d[ .]$'],
            'email' => ['required', 'email'],
            'pin' => ['required', 'regex:^[a-zA-Z0-9_.-]*$'],
            'role' => ['required']
        ]);

        DB::table('members')->insert([
            'name' => $request->name,
            'birth_date' => $request->birthdate,
            'address' => $request->address,
            'email' => $request->email,
            'pin' => $request->pin,
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return view('members');
    }

    public function search(Request $request)
    {
        $members = Member::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('address', 'like', '%' . $request->search . '%')
            ->orWhere('birth_date', 'like', '%' . $request->search . '%')
            ->paginate(20);
        return view("members", compact('members'));
    }
}
