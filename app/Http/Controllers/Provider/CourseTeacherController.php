<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EduTeachers_Provider;
use Validator;
use Helper;
use File;

class CourseTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_teachers'] = EduTeachers_Provider::valid()->orderBy('id', 'desc')->get();
        return view('provider.courseTeacher.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.courseTeacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teacher_name'   => 'required',
            'qualifications' => 'required',
            'teacher_image'  => 'required',
        ]);
        if ($validator->passes()) {
            $mainFile = $request->teacher_image;
            $imgPath = 'uploads/courseTeacher';
            $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 300, 380);
            if ($uploadResponse['status'] == 1) {
                EduTeachers_Provider::create([
                    'teacher_name'   => $request->teacher_name,
                    'teacher_email'  => $request->teacher_email,
                    'teacher_phone'  => $request->teacher_phone,
                    'qualifications' => $request->qualifications,
                    'teacher_image'  => $uploadResponse['file_name'],
                ]);
                $output['messege'] = 'Course Teacher has been created';
                $output['msgType'] = 'success';
            } else {
                $output['messege'] = $uploadResponse['errors'];
                $output['msgType'] = 'danger';
            }
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['teacher_info'] = EduTeachers_Provider::valid()->find($id);
        return view('provider.courseTeacher.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'teacher_name'   => 'required',
            'qualifications' => 'required',
        ]);
        if ($validator->passes()) {

            $courseTeacher = EduTeachers_Provider::find($id);
            if (isset($request->teacher_image)) {
                if ($request->teacher_image != $courseTeacher->teacher_image) {
                    $mainFile = $request->teacher_image;
                    $imgPath = 'uploads/courseTeacher';
                    $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 300, 380);
                    
                    if ($uploadResponse['status'] == 1) {
                        File::delete(public_path($imgPath.'/').$courseTeacher->teacher_image);
                        File::delete(public_path($imgPath.'/thumb/').$courseTeacher->teacher_image);
                        
                        EduTeachers_Provider::find($id)->update([
                            'teacher_name'   => $request->teacher_name,
                            'teacher_email'  => $request->teacher_email,
                            'teacher_phone'  => $request->teacher_phone,
                            'qualifications' => $request->qualifications,
                            'teacher_image'  => $uploadResponse['file_name'],
                        ]);
                        $output['messege'] = 'Course Teacher has been updated';
                        $output['msgType'] = 'success';

                    } else {
                        $output['messege'] = $uploadResponse['errors'];
                        $output['msgType'] = 'danger';
                    }
                } else {
                    EduTeachers_Provider::find($id)->update([
                        'teacher_name'   => $request->teacher_name,
                        'teacher_email'  => $request->teacher_email,
                        'teacher_phone'  => $request->teacher_phone,
                        'qualifications' => $request->qualifications
                    ]);
                    $output['messege'] = 'Course Teacher has been updated';
                    $output['msgType'] = 'success';
                }
            } else {
                EduTeachers_Provider::find($id)->update([
                    'teacher_name'   => $request->teacher_name,
                    'teacher_email'  => $request->teacher_email,
                    'teacher_phone'  => $request->teacher_phone,
                    'qualifications' => $request->qualifications
                ]);
                $output['messege'] = 'Course Teacher has been updated';
                $output['msgType'] = 'success';
            }
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseTeacher = EduTeachers_Provider::valid()->find($id);
        File::delete(public_path('uploads/courseTeacher/').$courseTeacher->teacher_image);
        File::delete(public_path('uploads/courseTeacher/thumb/').$courseTeacher->teacher_image);
        EduTeachers_Provider::valid()->find($id)->delete();
    }
}
