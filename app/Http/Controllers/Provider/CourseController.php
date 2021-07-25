<?php

namespace App\Http\Controllers\Provider;

use File;
use Helper;
use Validator;
use Illuminate\Http\Request;
use App\Models\EduCourses_Provider;
use App\Http\Controllers\Controller;
use App\Models\EduTeachers_Provider;
use App\Models\EduAssignCourseTeachers_Provider;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_courses'] = EduCourses_Provider::valid()->latest()->get();
        return view('provider.course.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.course.create');
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
            'course_name'     => 'required',
            'course_thumb'    => 'required',
            'course_overview' => 'required'
        ]);
        if ($validator->passes()) {
            $mainFile = $request->course_thumb;
            $imgPath = 'uploads/course';
            $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 640, 426);
            if ($uploadResponse['status'] == 1) {
                EduCourses_Provider::create([
                    'course_name'     => $request->course_name,
                    'course_thumb'    => $uploadResponse['file_name'],
                    'course_overview' => $request->course_overview,
                    'paid_status'     => 1,
                    'duration'        => $request->duration,
                ]);
                $output['messege'] = 'Course has been created';
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
        $data['course'] = EduCourses_Provider::valid()->find($id);
        return view('provider.course.update', $data);
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
            'course_name'     => 'required',
            // 'course_thumb'    => 'required',
            'course_overview' => 'required'
        ]);
        if ($validator->passes()) {
            $course = EduCourses_Provider::find($id);
            if (isset($request->course_thumb)) {
                if ($request->course_thumb != $course->course_thumb) {
                    $mainFile = $request->course_thumb;
                    $imgPath = 'uploads/course';
                    $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 640, 426);
                    
                    if ($uploadResponse['status'] == 1) {
                        File::delete(public_path($imgPath.'/').$course->course_thumb);
                        File::delete(public_path($imgPath.'/thumb/').$course->course_thumb);
                        
                        EduCourses_Provider::find($id)->update([
                            'course_name'     => $request->course_name,
                            'course_thumb'    => $uploadResponse['file_name'],
                            'course_overview' => $request->course_overview,
                            'paid_status'     => 1,
                            'duration'        => $request->duration,
                        ]);
                        $output['messege'] = 'Course has been updated';
                        $output['msgType'] = 'success';
                    } else {
                        $output['messege'] = $uploadResponse['errors'];
                        $output['msgType'] = 'danger';
                    }
                } else {
                    EduCourses_Provider::find($id)->update([
                        'course_name'     => $request->course_name,
                        'course_overview' => $request->course_overview,
                        'paid_status'     => 1,
                        'duration'        => $request->duration,
                    ]);
                    $output['messege'] = 'Course has been updated';
                    $output['msgType'] = 'success';
                }
            } else {
                EduCourses_Provider::find($id)->update([
                    'course_name'     => $request->course_name,
                    'course_overview' => $request->course_overview,
                    'paid_status'     => 1,
                    'duration'        => $request->duration,
                ]);
                $output['messege'] = 'Course has been updated';
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
        $course = EduCourses_Provider::valid()->find($id);
        File::delete(public_path('uploads/course/').$course->course_thumb);
        File::delete(public_path('uploads/course/thumb/').$course->course_thumb);
        EduCourses_Provider::valid()->find($id)->delete();
    }

    public function assignTeacher(Request $request)
    {
        $data['course_id'] = $course_id = $request->id;
        $data['teachers'] = EduTeachers_Provider::valid()->get();
        $data['assigned_teachers'] = EduAssignCourseTeachers_Provider::valid()->where('course_id', $course_id)->get()->pluck('teacher_id')->toArray();
        return view('provider.course.assignTeacher', $data);
    }
    public function assignTeacherAction(Request $request)
    {
        $data['course_id'] = $course_id = $request->id;
        $teachers_arr = $request->teachers;
        $validator = Validator::make($request->all(), [
            'teachers' => 'required',
        ]);

        if ($validator->passes()) {
            $old_teachers = EduAssignCourseTeachers_Provider::valid()->where('course_id', $course_id)->get()->keyBy('teacher_id')->all();

            $new_teacher_ids = array_filter($teachers_arr);
            if (!empty($old_teachers)) {
                foreach($old_teachers as $key => $oldValue) {
                    if(!in_array($key, $new_teacher_ids)) {
                        EduAssignCourseTeachers_Provider::find($oldValue->id)->delete();
                    }
                }
            }
            foreach($new_teacher_ids as $key => $teacher_id) 
            {
                if (!empty($old_teachers)) {
                    if(!array_key_exists($teacher_id, $old_teachers)) {
                        EduAssignCourseTeachers_Provider::create([
                            'course_id'  => $course_id,
                            'teacher_id' => $teacher_id
                        ]);
                    }
                } else {
                    EduAssignCourseTeachers_Provider::create([
                        'course_id'  => $course_id,
                        'teacher_id' => $teacher_id,
                    ]);
                }
            }

            $output['messege'] = 'Teachers has been Assigned';
            $output['msgType'] = 'success';

            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }
}
