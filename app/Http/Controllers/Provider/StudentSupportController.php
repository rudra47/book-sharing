<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\EduTraineeUser_Provider;

class StudentSupportController extends Controller
{
    public function index()
    {
        $data['all_students'] = EduTraineeUser_Provider::valid()->latest()->get();
        return view('provider.student.listData', $data);
    }
    //TRAINEE USER LOGIN
    public function traineeUserLogin(Request $request)
    {
        $userId = $request->id;
        $data = array(
            'id'            => $userId,
            'valid'         => 1
        );
        $user = EduTraineeUser_Provider::where('valid', 1)->find($userId);
        
        $output = array();
        
        if (!empty($user)) {
            Auth::loginUsingId($userId);
            $output["result"] = true;
        } else {
            $output["result"] = false;
            $output["msg"] = "Id is not valid or verified.";
        }
        return json_encode($output);
    }
}
