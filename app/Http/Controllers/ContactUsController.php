<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EduContactUs_Web;
use Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        $data['title'] = "Contact Us";
        return view('web.contactUs', $data);
    }
    public function contactFormAction(Request $request)
    {
        $output = array();
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required',
            'phone'   => 'required',
            'comment' => 'required'
        ]);
        if ($validator->passes()) {
            EduContactUs_Web::create([
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'comment' => $request->comment,
            ]);
            $output['messege'] = 'Message has been Send Succefully';
            $output['msgType'] = 'success';
            $output['status'] = 1;
        } else {
            $output['messege'] = 'Failed! All Fields are Required';
            $output['msgType'] = 'danger';
            $output['status'] = 0;
        }
        return response($output);
    }
}
