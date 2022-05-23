<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

use App\Models\Book;
use App\Models\Rental;

use AppHttpRequests;

class BookController extends Controller
{
    public function Books()
    {
        $books = DB::table("books")->where('deleted', '0')->paginate(12);

        return view("library", compact('books'));
    }

    public function search(Request $request)
    {
        $books = Book::where('title', 'like', '%' . $request->search . '%')
            ->orWhere('author', 'like', '%' . $request->search . '%')
            ->orWhere('publisher', 'like', '%' . $request->search . '%')
            ->orWhere('published', 'like', '%' . $request->search . '%')
            ->orWhere('quantity', 'like', '%' . $request->search . '%')
            ->orWhere('isbn', 'like', '%' . $request->search . '%')
            ->orWhere('isbn13', 'like', '%' . $request->search . '%')
            ->paginate(20);
        return view("library", compact('books'));
    }

    public function bookView($id)
    {
        $book = DB::table("books")->where("id", $id)->first();
        return view('books.bookview' , compact('book'));
    }

    public function addBook(Request $request)
    {
        $this->validate($request, [
            'title' => ['required','string', 'min:10', 'max:255'],
            'author' => ['required', 'string', 'min:5', 'max:255'],
            'publisher' => ['required', 'string', 'min:10', 'max:255'],
            'published' => ['required', 'integer', 'between:0,2022'],
            'quantity' => ['required', 'integer', 'min:1'],
            'isbn' => ['required', 'string', 'min:10', 'max:10'],
            'isbn13' => ['required', 'string', 'min:13', 'max:13'],
            'image' => ['required'],
        ]);

        $newImageName = time().'-'.$request->title . '.'.$request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        $path = 'images/' . $newImageName;

        DB::table('books')
            ->insert([
               'title' => $request->title,
               'author' => $request->author,
               'publisher' => $request->publisher,
               'published' => $request->published,
               'quantity' => $request->quantity,
               'isbn' => $request->isbn,
               'isbn13' => $request->isbn13,
               'image' => $path
            ]);
        return redirect('library');
    }

    public function editBook($id)
    {
        $book = DB::table("books")->where("id", $id)->first();
        return view('books.editView' , compact('book'));
    }

    public function updateBook(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required','string', 'min:10', 'max:255'],
            'author' => ['required', 'string', 'min:5', 'max:255'],
            'publisher' => ['required', 'string', 'min:10', 'max:255'],
            'published' => ['required', 'integer', 'between:0,2022'],
            'quantity' => ['required', 'integer', 'min:1'],
            'image' => ['required'],
        ]);

        $newImageName = time().'-'.$request->title . '.'.$request->image->extension();
        $request->image->move(public_path('images'), $newImageName);
        $path = 'images/' . $newImageName;

        $oldImagePath = DB::table('books')->where('id', $id)->value('image');
        File::delete($oldImagePath);
        DB::table('books')
            ->where('id', $id)->update([
               'title' => $request->title,
               'author' => $request->author,
               'publisher' => $request->publisher,
               'published' => $request->published,
               'quantity' => $request->quantity,
               'image' => $path
            ]);
        return redirect()->route('bookview', ['id' => $id]);
    }

    public function deleteAllBooks(Request $request)
    {
        $rental = Rental::where('bookID', $request->id)->get();
        $rented = count($rental);
        if($rented=0)
        {
            Book::where('id', $request->id)->update([
            'deleted'=>1
        ]);
            return redirect('library')->withSuccess('Books deleted successfully');
        } else {
            return redirect('library') ->withErrors('Couldn\'t delete all books because some copies of it are rented');
        }
    }
    public function deleteBook(Request $request)
    {
        //dd($request);
        $rental = Rental::where('bookID', $request->id)->get();
        $rented = count($rental);
        $book = Book::where('id', $request->id)->first();
        //dd($book);
        if($book->quantity - $rented > 0){
            $book->update([
                'quantity' => $book->quantity -1
            ]);
            return redirect('library')->withSuccess('Book deleted successfully');
        } else {
            return redirect('library')->withErrors('There are no more books avaible');
        }
    }
}
