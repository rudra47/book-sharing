<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function show()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        // ->route('id') gets route user id and getKey() gets current user id() 
        // do not forget that you must send Authorization header to get the user from the request
        if ($request->route('id') == $request->user()->getKey() &&
            $request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // return response()->json('Email verified!');
        return redirect($this->redirectPath());
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            // return response()->json('User already have verified email!', 422);
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();
        // return response()->json('The notification has been resubmitted');
        return back()->with('resent', true);
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
