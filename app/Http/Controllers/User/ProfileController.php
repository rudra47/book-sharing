<?php

namespace App\Http\Controllers\User;

use Auth;
use File;
use Helper;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users_user;


class ProfileController extends Controller
{
    public function index()
    {
        $authId = Auth::id();
    	$data['user_info'] = Users_user::valid()->find($authId);
        // dd($data);
        return view('user.profile', $data);
    }

    public function updateProfile(Request $request,$id){
    	$validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);
        if ($validator->passes()) {
            $user = Users_user::find($id);
            if (isset($request->provider_image)) {

                if ($request->provider_image != $user->image) {
                    $mainFile = $request->provider_image;
                    $imgPath = 'uploads/userProfile';
                    $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 640, 426);
                    
                    if ($uploadResponse['status'] == 1) {
                        File::delete(public_path($imgPath.'/').$user->image);
                        File::delete(public_path($imgPath.'/thumb/').$user->image);
                        // dd($uploadResponse['file_name']);
                        Users_user::find($id)->update([
                            'image'    => $uploadResponse['file_name'],
                            'name'     => $request->name,
	                        'address'  => $request->address,
	                        'phone'    => $request->phone
                        ]);


                        $output['messege'] = 'User has been updated';
                        $output['msgType'] = 'success';
                    } else {
                        $output['messege'] = $uploadResponse['errors'];
                        $output['msgType'] = 'danger';
                    }
                } else {
                    Users_user::find($id)->update([
                        'name'     => $request->name,
                        'address'  => $request->address,
                        'phone'    => $request->phone
                    ]);
                    $output['messege'] = 'Provider has been updated';
                    $output['msgType'] = 'success';
                }
            } else {

                Users_user::find($id)->update([
                        'name'     => $request->name,
                        'address'  => $request->address,
                        'phone'    => $request->phone
                    ]);
                $output['messege'] = 'Provider has been updated';
                $output['msgType'] = 'success';
            }
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    public function updatePassword(Request $request,$id){

    	$validator = Validator::make($request->all(), [
            'password'   => 'required',
        ]);

        if ($validator->passes()) {

            if(!empty($request->password)){

                Users_user::find($id)->update([
                    'password'    => Hash::make($request->password),
               ]);

            }
            
            $output['messege'] = 'Provider has been updated';
            $output['msgType'] = 'success';

            return redirect()->back()->with($output);

        } else {
            return redirect()->back()->withErrors($validator);
        }
    }
}
