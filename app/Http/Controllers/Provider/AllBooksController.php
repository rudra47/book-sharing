<?php

namespace App\Http\Controllers\Provider;

use File;
use Helper;
use Validator;
use Illuminate\Http\Request;
use App\Models\User_provider;
use App\Models\Book_provider;
use App\Http\Controllers\Controller;

class AllBooksController extends Controller
{
    public function allBooks()
    {
        $data['books'] = $books = Book_provider::join('book_categories', 'book_categories.id', '=', 'books.category_id')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->join('languages', 'languages.id', '=', 'books.language_id')
            ->select('books.*', 'book_categories.name as category_name', 'authors.name as author_name', 'languages.name as language_name')
            ->where('books.valid', 1)
            ->orderBy('approved_status')
            ->get();

        return view('provider.allBooks.listData', $data);
    }

    

    public function bookApproval($book_id)
    {
        $data['book'] = Book_provider::where('id', $book_id)
            ->where('valid', 1)
            ->first();

        return view('provider.allBooks.bookApproval', $data);
    }

    public function bookApprovalAction(Request $request, $book_id)
    {
        $validator = Validator::make($request->all(), [
            'approved_status'     => 'required'
        ]);
        if ($validator->passes()) {
            Book_provider::find($book_id)->update(['approved_status' => $request->approved_status]);
            
            $output['messege'] = 'Book Approve Status has been Updated';
            $output['msgType'] = 'success';
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }
}
