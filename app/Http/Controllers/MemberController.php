<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\Member;
use App\Models\Rental;

class MemberController extends Controller
{
    public function Members()
    {
        $members = DB::table("members")->where('deleted', '0')->paginate(20);
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

    public function editMember($id)
    {
        $member = Member::where('id', $id)->first();
        return view('members.editMember', ['id' => $id, 'member' => $member]);
    }

    public function updateMember(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'birthdate' => ['required'],
            'address' => ['required'],
            'email' => ['required'],
            'pin' => ['required'],
            'submit' => ['']
        ]);
        $member = Member::where('id', $request->id)->first();
        $member->update([
            'name' => $request->name,
            'birth_date' => $request->birthdate,
            'address' => $request->address,
            'email' => $request->email,
            'pin' => $request->pin,
            'role' => $request->role
        ]);
        return redirect("members")->withSuccess('Member updated successfully');
    }

    public function deleteMember(Request $request)
    {
        //dd ($request);
        $rental = Rental::where('memberID', $request->id)->where('returned', 0)->get();
        $rented = count($rental);
        //dd ($rental);
        if($rented>0)
        {
            return redirect('members') ->withErrors('Member has ongoing rental');
            
        } else {
            Member::where('id', $request->id)->update([
            'deleted'=>1
        ]);
            return redirect('members')->withSuccess('Member deleted successfully');
        }
    }
}
