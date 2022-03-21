<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

use AppHttpRequests;

class LibraryController extends Controller
{
    public function Books()
    {
        $books = DB::table("books")->paginate(12);
        return view("library", compact('books'));
    }

    public function bookView($id)
    {
        $book = DB::table("books")->where("id", $id)->first();
        return view('bookview' , compact('book'));
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

    public function editView($id)
    {
        $book = DB::table("books")->where("id", $id)->first();
        return view('editView' , compact('book'));
    }

    public function editBook(Request $request, $id)
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
}
