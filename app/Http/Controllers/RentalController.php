<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Book;
use App\Models\Member;
use App\Models\Rental;

class RentalController extends Controller
{
    public function Rentals()
    {
        $rentals = DB::table("rentals")->paginate(20);
        return view("rentals", compact('rentals'));
    }

    /* Returns deadline as datetime. */
    public function deadline(Request $request)
    {
        $role = Member::where('PIN', '=', $request->PIN)->first('role')->role;

        switch($role) {
            case('US'):
                return now()->addMonth(1);

            case('UL'):
                return now()->addMonth(12);

            case('OU'):
                return now()->addMonth(1);

            case('EE'):
                return now()->addDays(14);

            default:
                //We could do like an error thing
                return 0;
        }
    }

    /* Returns true if the member has too many rentals. */
    public function isAboveLimit(Request $request)
    {
        $role = Member::where('PIN', '=', $request->PIN)->first('role')->role;
        $my_memberID = Member::where('PIN', '=', $request->PIN)->first('id')->id;
        $unsettled_rentals = Rental::where('memberID', '=', $my_memberID)->count();
        
        switch($role) {
            case('US'):
                if ($unsettled_rentals >= 5)
                    return true;

            case('UL'):
                return false;

            case('OU'):
                if ($unsettled_rentals >= 4)
                    return true;

            case('EE'):
                if ($unsettled_rentals >= 2)
                    return true;

            default:
                return false;
        }
    }
        
    public function isBookAvailable(Request $request)
    {
        if (Book::where('isbn', '=', $request->isbn)->first('quantity')->quantity > 0) 
            return true;
        else
            return false;
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'PIN' => ['required', 'exists:members,PIN'],
            'isbn'   => ['required', 'exists:books,isbn']
        ]);

        if ($this->isAboveLimit($request)) {
            return redirect('rentals/addrental')
                ->withErrors()
                ->withInput();
        }

        if (!$this->isBookAvailable($request)) {
            return redirect('rentals/addrental')
                ->withErrors()
                ->withInput();
        }

        DB::table('rentals')->insert([
            'memberID' => Member::where('PIN', '=', $request->PIN)->first('id')->id,
            'bookID' => Book::where('isbn', '=', $request->isbn)->first('id')->id,
            'deadline' => $this->deadline($request),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('rentals');
    }

    public function search(Request $request)
    {
        $my_memberID = Member::where('PIN', '=', $request->search)->first('id')->id;
        $rentals = Rental::where('memberID', 'like', '%' . $my_memberID . '%')
            ->paginate(20);
        return view("rentals", compact('rentals'));
    }

    public function rentalView($id)
    {
        $rental = DB::table("rentals")->where("id", $id)->first();
        return view('rentals.rentalview', compact('rental'));
    }
}
