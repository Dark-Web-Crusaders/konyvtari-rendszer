<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\Book;
use App\Models\Member;
use App\Models\Rental;

class RentalController extends Controller
{
    public function Rentals()
    {
        $rentals = DB::table("rentals")
            ->where('returned', '=', '0')
            ->select('*', \DB::raw("rentals.id as rentalID"))
            ->join('books', 'rentals.bookID', '=', 'books.id')
            ->join('members', 'rentals.memberID', '=', 'members.id')
            ->paginate(20);
        return view("rentals", compact('rentals'));
    }

    public function fulfilledRentals()
    {
        $rentals = DB::table("rentals")
            ->where('returned', '=', '1')
            ->join('books', 'rentals.bookID', '=', 'books.id')
            ->join('members', 'rentals.memberID', '=', 'members.id')
            ->paginate(20);
        return view("history", compact('rentals'));
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
                return 0;
        }
    }

    /* Returns true if the member has too many rentals. */
    public function isAboveLimit(Request $request)
    {
        $role = Member::where('PIN', '=', $request->PIN)->first('role')->role;
        $my_memberID = Member::where('PIN', '=', $request->PIN)->first('id')->id;
        $unsettled_rentals = Rental::where('memberID', '=', $my_memberID)->where('returned', '=', 0)->count();
        
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
            return back()
                ->withInput()
                ->with('status', 'Member is not allowed to have any more outstading book rentals');
        }

        if (!$this->isBookAvailable($request)) {
            return back()
                ->withInput()
                ->with('status', 'The book has no copies available to be borrowed');
        }

        DB::table('rentals')->insert([
            'memberID' => Member::where('PIN', '=', $request->PIN)->first('id')->id,
            'bookID' => Book::where('isbn', '=', $request->isbn)->first('id')->id,
            'deadline' => $this->deadline($request),
            'created_at' => now(),
            'updated_at' => now(),
            'returned' => 0
        ]);

        return redirect('rentals');
    }

    public function search(Request $request)
    {
        try
        {
            $my_memberID = Member::where('PIN', '=', $request->search)->first('id')->id;
            $rentals = Rental::where('memberID', '=', $my_memberID)
                ->where('returned', '=', 0)
                ->select('*', \DB::raw("rentals.id as rentalID"))
                ->join('books', 'rentals.bookID', '=', 'books.id')
                ->join('members', 'rentals.memberID', '=', 'members.id')
                ->paginate(20);
        } catch(Exception $e) {
            return redirect()->back()->withErrors('Searched pin could not be found.');
        }
        
        return view("rentals", compact('rentals'));
    }

    public function historySearch(Request $request)
    {
        try
        {
        $my_memberID = Member::where('PIN', '=', $request->search)->first('id')->id;
        $rentals = Rental::where('memberID', '=', $my_memberID)
            ->where('returned', '=', 1)
            ->select('*', \DB::raw("rentals.id as rentalID"))
            ->join('books', 'rentals.bookID', '=', 'books.id')
            ->join('members', 'rentals.memberID', '=', 'members.id')
            ->paginate(20);
        } catch(Exception $e) {
            return redirect()->back()->withErrors('Searched pin could not be found.');
        }
        
        return view("history", compact('rentals'));
    }

    public function rentalView($id)
    {
        $rental = DB::table("rentals")
            ->where('rentals.id', '=', $id)
            ->select('*', \DB::raw("rentals.id as rentalID"))
            ->join('books', 'rentals.bookID', '=', 'books.id')
            ->join('members', 'rentals.memberID', '=', 'members.id')
            ->first();
        return view('rentals.rentalview', compact('rental'));
    }

    public function update(Rental $rental)
    {
        $rental->update([
            'returned' => 1
        ]);

        return redirect('rentals');
    }
}
