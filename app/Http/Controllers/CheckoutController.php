<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookRequests_user;
use App\Models\Book_user;
use App;
use Auth;

class CheckoutController extends Controller
{
    public function checkoutAction(Request $request)
    {
        // dd($request->all());
        $book_ids = $request->book_id;
        // dd($book_ids);
        $auth_id = Auth::id();
        $preData = BookRequests_user::valid()->first();
        // echo "<pre>";
        // print_r($preData);
        // exit();
        if (!empty($preData)) {
            // $alreadyTaken = Book_user::where('valid', 1)
            //     ->whereIn('book_id', $book_ids)
            //     ->where('sender_id', $auth_id)
            //     ->first();

            $alreadyTaken = BookRequests_user::where('valid', 1)
                ->whereIn('book_id', $book_ids)
                ->where('sender_id', $auth_id)
                ->first();
            // dd('hhhh',$alreadyTaken);
            if (empty($alreadyTaken)) {
                // dd(1);
                foreach ($book_ids as $key => $book_id) {
                    $bookData = Book_user::find($book_id);
                    BookRequests_user::create([
                        'book_id' => $book_id,
                        'sender_id' => $auth_id,
                        'owner_id' => $bookData->created_by,
                        'status_update_time' => now()
                    ]);
                }
            }else {
                $output['messege'] = 'Request Send Successfully';
                $output['msgType'] = 'success';
            }
        }else {
            // if (count($book_ids) > 1) {
                foreach ($book_ids as $key => $book_id) {
                    $bookData = Book_user::find($book_id);
                    BookRequests_user::create([
                        'book_id' => $book_id,
                        'sender_id' => $auth_id,
                        'owner_id' => $bookData->created_by,
                        'status_update_time' => now()
                    ]);
                }
            // }else{
            //     $bookData = Book_user::find($book_id[0]);
            //     BookRequests_user::create([
            //         'book_id' => $book_id[0],
            //         'sender_id' => $auth_id,
            //         'owner_id' => $bookData->created_by,
            //         'status_update_time' => now()
            //     ]);
            // }
        }
        

        session()->forget('cart');

        $output['messege'] = 'Request Send Successfully';
        $output['msgType'] = 'success';

        return redirect('/viewCart')->with($output);
    }
}
