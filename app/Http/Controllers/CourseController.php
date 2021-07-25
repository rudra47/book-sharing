<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Validator;
use DateInterval;
use Illuminate\Http\Request;
use App\Models\EduCourses_Web;
use App\Models\EduTraineeUser_Web;
use App\Models\EduAssignCourses_Web;
use App\Models\EduAssignCoursePackage_Web;
use App\Models\EduAssignPackageEnroll_Web;
use App\Models\EduAssignCourseTeachers_Web;
use App\Models\EduAssignPackageFeatures_Web;

class CourseController extends Controller
{
    public function courses()
    {
        $data['title'] = "Courses";
        // $data['courses'] = $courses = EduAssignCoursePackage_Web::join('edu_courses', 'edu_courses.id', '=', 'edu_assign_course_packages.course_id')
        //         ->select('edu_assign_course_packages.*', 'edu_assign_course_packages.course_id as course_id', 'edu_courses.course_name', 'edu_courses.course_thumb')
        //         ->where('edu_assign_course_packages.publish_status', 1)   
        //         ->where('edu_assign_course_packages.valid', 1)
        //         ->groupBy('course_id')
        //         ->get();
        $assigned_pack_course_ids =  EduAssignCoursePackage_Web::valid()->where('edu_assign_course_packages.publish_status', 1)->get()->pluck('course_id')->unique();
        $data['courses'] = $courses = EduCourses_Web::valid()->whereIn('id', $assigned_pack_course_ids)->get();
        if (Auth::check()) {
            $authId = Auth::id();
            foreach ($courses as $key => $course) {
                $course->isEnrolled = EduAssignPackageEnroll_Web::join('edu_assign_course_packages', 'edu_assign_course_packages.id', '=', 'edu_assign_package_enrolls.assign_package_id')
                    ->where('edu_assign_course_packages.course_id', $course->id)
                    ->where('edu_assign_package_enrolls.trainee_id', $authId)
                    ->count();
            }
        }
        return view('web.courses', $data);
    }
    public function courseOverview(Request $request)
    {
        $hasPackage = EduAssignCoursePackage_Web::valid()->where('course_id', $request->course_id)->first();
        if ($hasPackage) {
            
            $data['courseDetails'] = $courseDetails = EduCourses_Web::valid()->find($request->course_id);
            if ($courseDetails) {
                $data['hasCourse'] = true;
                // THIS COURSE PACKAGES
                $data['course_packages'] = $course_packages = EduAssignCoursePackage_Web::valid()->where('course_id', $request->course_id)->get();
                foreach ($course_packages as $key => $package) {
                        $package->features = EduAssignPackageFeatures_Web::valid()->where('assign_package_id', $package->id)->get();
                }
                // HAVE ANY ENROLLED PACKAGE OF THIS COURSE (AUTH USER ONLY)
                if (Auth::check()) {
                    $authId = Auth::id();
                    foreach ($course_packages as $key => $package) {
                        $package->isEnrolled = EduAssignPackageEnroll_Web::valid()
                                ->where('assign_package_id', $package->id)
                                ->where('trainee_id', $authId)
                                ->count();
                    }
                }
                // THIS COURSE TEACHERS
                $data['course_teachers'] = EduAssignCourseTeachers_Web::join('edu_teachers', 'edu_teachers.id', '=', 'edu_assign_course_teachers.teacher_id')
                    ->select('edu_assign_course_teachers.*', 'edu_teachers.teacher_name', 'edu_teachers.teacher_image')
                    ->where('edu_assign_course_teachers.course_id', $request->course_id)
                    ->where('edu_assign_course_teachers.valid', 1)
                    ->get();

                // OTHERS COURSES
                $assigned_pack_course_ids =  EduAssignCoursePackage_Web::valid()->where('course_id', '!=', $request->course_id)->where('edu_assign_course_packages.publish_status', 1)->get()->pluck('course_id')->unique();
                $data['courses'] = EduCourses_Web::valid()->whereIn('id', $assigned_pack_course_ids)->get();

            } else {
                $data['hasCourse'] = false;
            }
        } else {
            $data['hasCourse'] = false;
        }
        return view('web.courseOverview', $data);
    }
    public function courseApply(Request $request)
    {
        $authId = Auth::id();
        $formType = $request->formType;
        if ($formType == 1) { //for package_id 
            $package_id = $request->package_id;
            $data['course_package'] = $course_package = EduAssignCoursePackage_Web::valid()->find($package_id);
            $course_id = $course_package->course_id; 
            
        } else { //for course_id
            $course_id = $request->package_id;
            $data['course_package'] = null;
        }
        $enrolled_package_ids = EduAssignPackageEnroll_Web::valid()
            ->where('course_id', $course_id)
            ->where('trainee_id', $authId)
            ->get()->pluck('assign_package_id');
        $data['this_course_packages'] = EduAssignCoursePackage_Web::valid()->whereNotIn('id', $enrolled_package_ids)->where('course_id', $course_id)->get();
        $data['courseDetails'] = EduCourses_Web::valid()->find($course_id);
        $data['profileInfo'] = EduTraineeUser_Web::valid()->find($authId);
        return view('web.courseApplyForm', $data);
    }

    public function coursePackageInfo(Request $request)
    {
        $authId = Auth::id();
        $course_package_info = EduAssignCoursePackage_Web::valid()->find($request->package_id);
        if ($course_package_info) {
            $data['package_name'] = $course_package_info->package_name;
            $data['package_price'] = $course_package_info->price;
            $data['package_duration'] = $course_package_info->duration;
            $data['package_type'] = $course_package_info->package_type == 1 ? 'Online' : 'Offline';
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        return response($data);
    }
    
    public function courseApplyAction(Request $request)
    {
        $authId = Auth::id();
        $output = array();
        $validator = Validator::make($request->all(), [
            'package_id' => 'required',
            'phone'      => 'required'
        ]);
        if ($validator->passes()) {
            $package_info = EduAssignCoursePackage_Web::valid()->find($request->package_id);
            $curDateTime = new DateTime();
            $endingTime = new DateTime();
            $endingTime->add(new DateInterval('P'.(($package_info->duration>0)?$package_info->duration:0).'D'));
            $isEnrolled = EduAssignPackageEnroll_Web::valid()->where('course_id', $package_info->course_id)->where('assign_package_id', $request->package_id)->first();
            if (empty($isEnrolled)) {
                EduAssignPackageEnroll_Web::create([
                    'course_id'         => $package_info->course_id,
                    'assign_package_id' => $request->package_id,
                    'trainee_id'        => $authId,
                    'phone'             => $request->phone,
                    'start_date'        => $curDateTime->format('Y-m-d'),
                    'end_date'          => $endingTime->format('Y-m-d')
                ]);
                $output['messege'] = 'Course has been Succefully Enrolled.';
                $output['msgType'] = 'success';
                $output['status'] = 1;
            } else {
                $output['messege'] = 'Course Already Enrolled.';
                $output['msgType'] = 'danger';
                $output['status'] = 0;
            }
        } else {
            $output['messege'] = 'Failed! All Fields are Required';
            $output['msgType'] = 'danger';
            $output['status'] = 0;
        }
        return response($output);
    }

    public function myCourses()
    {
        $data['title'] = "My Courses";
        if (Auth::check()) {
            $authId = Auth::id();
            $enrolled_pack_course_ids =  EduAssignPackageEnroll_Web::valid()->where('trainee_id', $authId)->get()->pluck('course_id')->unique();
            $data['courses'] = EduCourses_Web::valid()->whereIn('id', $enrolled_pack_course_ids)->get();
        }
        return view('web.myCourses', $data);
    }
    public function myCoursePackages(Request $request)
    {
        if (Auth::check()) {
            $authId = Auth::id();
            $enrolled_package_ids = EduAssignPackageEnroll_Web::valid()
                ->where('trainee_id', $authId)
                ->where('course_id', $request->course_id)
                ->get()
                ->pluck('assign_package_id')
                ->unique();

            $data['course_packages'] = $course_packages = EduAssignCoursePackage_Web::valid()->whereIn('id', $enrolled_package_ids)->get();
            foreach ($course_packages as $key => $package) {
                $package->features = EduAssignPackageFeatures_Web::valid()->where('assign_package_id', $package->id)->get();
            }
            $data['courseDetails'] = EduCourses_Web::valid()->find($request->course_id);
        }
        return view('web.myCoursePackages', $data);
    }

}
