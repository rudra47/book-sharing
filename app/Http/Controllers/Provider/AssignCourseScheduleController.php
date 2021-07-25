<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EduCourses_Provider;
use App\Models\EduAssignCourses_Provider;
use App\Models\EduAssignCourseSchedules_Provider;
use Validator;
use Helper;
use DateTime;

class AssignCourseScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['assign_id'] = $assign_id = $request->assign_id;
        $assignCourseInfo = EduAssignCourses_Provider::valid()->find($assign_id);
        $data['course_name'] = EduCourses_Provider::valid()->find($assignCourseInfo->course_id)->course_name;
        $data['all_schedules'] = EduAssignCourseSchedules_Provider::valid()->where('assign_course_id', $assign_id)->orderBy('id', 'desc')->get();
        return view('provider.courseSchedule.scheduleListData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['assign_id'] = $assign_id = $request->assign_id;
        return view('provider.courseSchedule.create', $data);
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
            'batch_no'         => 'required',
            'assign_course_id' => 'required',
            'schedule_title'   => 'required',
            'start_date'       => 'required',
            'start_time'       => 'required',
            'start_url'        => 'required'
        ]);
        if ($validator->passes()) {
            EduAssignCourseSchedules_Provider::create([
                'batch_no'         => $request->batch_no,
                'assign_course_id' => $request->assign_course_id,
                'schedule_title'   => $request->schedule_title,
                'start_date'       => Helper::dateYMD($request->start_date),
                'start_time'       => Helper::timeHi24($request->start_time),
                'start_url'        => $request->start_url
            ]);
            $output['messege'] = 'Schedule has been created';
            $output['msgType'] = 'success';
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
        $data['schedule_info'] = EduAssignCourseSchedules_Provider::valid()->find($id);
        return view('provider.courseSchedule.update', $data);
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
            'batch_no'         => 'required',
            'schedule_title'   => 'required',
            'start_date'       => 'required',
            'start_time'       => 'required',
            'start_url'        => 'required'
        ]);
        if ($validator->passes()) {
            EduAssignCourseSchedules_Provider::find($id)->update([
                'batch_no'       => $request->batch_no,
                'schedule_title' => $request->schedule_title,
                'start_date'     => Helper::dateYMD($request->start_date),
                'start_time'     => Helper::timeHi24($request->start_time),
                'start_url'      => $request->start_url
            ]);
            $output['messege'] = 'Schedule has been Updated';
            $output['msgType'] = 'success';
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
        EduAssignCourseSchedules_Provider::valid()->find($id)->delete();
    }
    
    public function scheduledCourses()
    {
        $data['all_assign_courses'] = EduAssignCourses_Provider::join('edu_courses', 'edu_courses.id', '=', 'edu_assign_courses.course_id')
            ->join('edu_teachers', 'edu_teachers.id', '=', 'edu_assign_courses.assign_teacher_id')
            ->select('edu_assign_courses.*', 'edu_courses.course_name', 'edu_teachers.teacher_name')
            ->where('edu_assign_courses.valid', 1)
            ->orderBy('edu_assign_courses.id', 'desc')
            ->get();
        return view('provider.courseSchedule.courseListData', $data);
    }

}
