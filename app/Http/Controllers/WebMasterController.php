<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users_user;
use App;
use Validator;
use App\Http\Controllers\User\MasterController;

class WebMasterController extends Controller
{
    public function login()
    {
        return view('web.login');
    }
    public function loginAction(Request $request)
    {
        $master = new MasterController;
        return $master->postLogin($request);
    }
    public function register()
    {
        return view('web.register');
    }
    public function registerAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'phone'      => 'required',
            'address'    => 'required',
            'password'   => 'required'
        ]);
        if ($validator->passes()) {
            Users_user::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'password'   => bcrypt($request->password),
                'valid'      => 1
            ]);
            $output['message'] = 'Registration Successfully';
            $output['msgType'] = 'success';

            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }
}