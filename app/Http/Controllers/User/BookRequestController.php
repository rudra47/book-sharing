<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Validator;
use App\Models\BookRequests_user;
use App\Models\Book_user;

class BookRequestController extends Controller
{
    public function index(){
        $authId = Auth::id();
        // $data['userInfo'] = User::where('valid', 1)->find($authId);

        $data['bookRequestInfos'] = BookRequests_user::join('users', 'users.id', '=', 'book_requests.sender_id')
            ->join('books', 'books.id', '=', 'book_requests.book_id')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->select('book_requests.*', 'users.first_name as user_first_name', 'users.last_name as user_last_name', 'books.title as book_title', 'books.book_thumb', 'authors.name as author_name')
            ->where('book_requests.owner_id', $authId)
            ->where('book_requests.valid', 1)
            ->get();

        return view('user.bookRequest.listData', $data);
    }

    public function requestControl(Request $request, $id)
    {
        $data['bookRequestInfo'] = BookRequests_user::find($id);
        return view('user.bookRequest.requestControl', $data);
    }
    public function requestControlAction(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);
        if ($validator->passes()) {
            BookRequests_user::find($id)->update([
                'status' => $request->status
            ]);

            $output['messege'] = 'Book request has been updated';
            $output['msgType'] = 'success';

            return redirect()->back()->with($output);
        }else {
            return redirect()->back()->withErrors($validator);
        }
    }
}
