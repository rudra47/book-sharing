<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EduCompanyWorkFlow_Provider;
use Validator;
use Helper;
use File;

class WorkFlowController extends Controller
{
    public function workFlow()
    {
        $data['workflow'] = EduCompanyWorkFlow_Provider::valid()->first();
        return view('provider.workFlow.update', $data);
    }

    public function saveWorkFlow(Request $request)
    {
        $output = [];
        $workflow = EduCompanyWorkFlow_Provider::valid()->first();
        if (empty($workflow)) {
            $validator = Validator::make($request->all(), [
                'image_name' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                // 'image_name' => 'required'
            ]);
        }
        
        if ($validator->passes()) {
            $imgPath = 'uploads/workflows';

            if (empty($workflow)) {
                $mainFile = $request->image_name;
                $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath);
                if ($uploadResponse['status'] == 1) {
                    EduCompanyWorkFlow_Provider::create([
                        'image_name' => $uploadResponse['file_name'],
                        'status'     => 1
                    ]);
                    $output['messege'] = 'Work flow has been created';
                    $output['msgType'] = 'success';
                } else {
                    $output['messege'] = $uploadResponse['errors'];
                    $output['msgType'] = 'danger';
                }
            } else {
                if (isset($request->image_name)) {
                    if ($request->image_name != $workflow->image_name) {
                        $mainFile = $request->image_name;
                        $imgPath = 'uploads/workflows';
                        $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath);
                        
                        if ($uploadResponse['status'] == 1) {
                            File::delete(public_path($imgPath.'/').$workflow->image_name);
                            File::delete(public_path($imgPath.'/thumb/').$workflow->image_name);
                            
                            EduCompanyWorkFlow_Provider::find($id)->update([
                                'image_name' => $uploadResponse['file_name'],
                                'status'     => 1
                            ]);
                            $output['messege'] = 'Work flow has been updated';
                            $output['msgType'] = 'success';
                        } else {
                            $output['messege'] = $uploadResponse['errors'];
                            $output['msgType'] = 'danger';
                        }
                    } else {
                        $output['messege'] = 'Work flow has been updated';
                        $output['msgType'] = 'success';
                    }
                } else {
                    $output['messege'] = 'Work flow has been updated';
                    $output['msgType'] = 'success';
                }
            }
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }
}
