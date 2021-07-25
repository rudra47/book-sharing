<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use File;
use Image;
use Validator;
use Illuminate\Http\Request;
use App\Models\EduTraineeUser_Web;
use App\Models\EduStudentSocialLinks_Web;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }
    public function index()
    {
        $authId = Auth::id();
        $data['title'] = "Profile";
        $data['myProfile'] = EduTraineeUser_Web::valid()->find($authId);
        $data['socialLinkInfo'] = EduStudentSocialLinks_Web::valid()->find($authId);
        return view('web.userProfile.profile', $data);
    }
    public function profileInfo()
    {
        $authId = Auth::id();
        $data['title'] = "Profile Info";
        $data['profileInfo'] = EduTraineeUser_Web::valid()->find($authId);
        return view('web.userProfile.profileInfo', $data);
    }
    public function updateProfile()
    {
        $authId = Auth::id();
        $data['title'] = "Update Profile";
        $data['profileInfo'] = EduTraineeUser_Web::valid()->find($authId);
        return view('web.userProfile.updateProfile', $data);
    }
    public function updateProfileStore(Request $request)
    {
        $output = array();
        $authId = Auth::id();
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'phone'   => 'required'
        ]);
        if ($validator->passes()) {
            EduTraineeUser_Web::find($authId)->update([
                'name'    => $request->name,
                'phone'   => $request->phone,
            ]);
            $output['messege'] = 'Profile has been Updated';
            $output['msgType'] = 'success';
            $output['status'] = 1;
        } else {
            $output['messege'] = 'Failed! All Fields are Required';
            $output['msgType'] = 'danger';
            $output['status'] = 0;
        }
        return response($output);
    }

    public function updateSocialLink()
    {
        $authId = Auth::id();
        $data['title'] = "Update Social Link";
        $data['socialLinkInfo'] = EduStudentSocialLinks_Web::valid()->where('user_id', $authId)->first();
        return view('web.userProfile.updateSocialLink', $data);
    }
    public function saveSocialLink(Request $request)
    {
        $output = array();
        $authId = Auth::id();
        $validator = Validator::make($request->all(), [
            // 'name'    => 'required',
            // 'phone'   => 'required'
        ]);
        if ($validator->passes()) {
            $isExist = EduStudentSocialLinks_Web::valid()->find($authId);
            if (!$isExist) {
                EduStudentSocialLinks_Web::create([
                    'user_id'       => $authId,
                    'fb_link'       => $request->fb_link,
                    'twitter_link'  => $request->twitter_link,
                    'linkedin_link' => $request->linkedin_link,
                ]);
            } else {
                EduStudentSocialLinks_Web::find($authId)->update([
                    'user_id'       => $authId,
                    'fb_link'       => $request->fb_link,
                    'twitter_link'  => $request->twitter_link,
                    'linkedin_link' => $request->linkedin_link,
                ]);
            }
            $output['messege'] = 'Profile Social Link has been Updated';
            $output['msgType'] = 'success';
            $output['status'] = 1;
        } else {
            $output['messege'] = 'Failed! All Fields are Required';
            $output['msgType'] = 'danger';
            $output['status'] = 0;
        }
        return response($output);
    }
    public function changePassword()
    {
        $data['title'] = "Change Password";
        return view('web.userProfile.changePassword');
    }
    public function savePassword(Request $request)
    {
        $output = array();
        $authId = Auth::id();
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;

        $userInfo = EduTraineeUser_Web::valid()->find($authId);

        if(Hash::check($oldPassword, $userInfo->password)) {
            EduTraineeUser_Web::find($authId)->update(['password' => Hash::make($newPassword)]);
            
            $output['status'] = 'success';
            $output['message'] = 'Password successfully updated';
        } else {
            $output['status'] = 'danger';
            $output['message'] = 'Old password is not correct';
        }
        return response($output);
    }
    
    public function changeImage()
    {
        $authId = Auth::id();
        $data['myProfile'] = EduTraineeUser_Web::valid()->find($authId);
        return view('web.userProfile.changeImage', $data);
    }

    public function saveImage(Request $request)
    {
        $authId = Auth::id();
        $data = $request->image;
 
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $imageName = time().'.png';
        $path = public_path('uploads/studentProfile/');
        file_put_contents($path.$imageName, $data);
        //create instance
        $img = Image::make($path.$imageName);
        //resize image
        $img->resize(80, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path.'thumb/'.$imageName); //save the same file as thumb
        $userInfo = EduTraineeUser_Web::find($authId);
        if(!empty($userInfo->image)) {
            File::delete(public_path($path.'/').$userInfo->image);
            File::delete(public_path($path.'thumb/').$userInfo->image);
        }
        //UPDATE NAME TO TRAINEE USERS TABLE
        $userInfo->update(['image'=>$imageName]);
        
        $output['messege'] = 'Your Profile has been updated';
        $output['msgType'] = 'success';
        $output['status'] = 1;
        
        return response($output);
    }
}
