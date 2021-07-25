<?php

namespace App\Http\Controllers\Provider;

use Helper;
use Validator;
use Illuminate\Http\Request;
use App\Models\EduCourses_Provider;
use App\Http\Controllers\Controller;
use App\Models\EduTeachers_Provider;
use App\Models\EduCoursePackage_Provider;
use App\Models\EduAssignCoursePackage_Provider;
use App\Models\EduAssignPackageFeatures_Provider;

class AssignCoursePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_assign_packages'] = EduAssignCoursePackage_Provider::join('edu_courses', 'edu_courses.id', '=', 'edu_assign_course_packages.course_id')
            ->select('edu_assign_course_packages.*', 'edu_courses.course_name')
            ->where('edu_assign_course_packages.valid', 1)
            ->orderBy('edu_assign_course_packages.id', 'desc')
            ->get();
        return view('provider.assignPackage.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['courses'] = EduCourses_Provider::valid()->latest()->get();
        return view('provider.assignPackage.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = [
            'course_id'        => 'required',
            'package_type'     => 'required',
            'package_name'     => 'required',
            'package_subtitle' => 'required',
            'paid_status'      => 'required',
            'duration'         => 'required'
        ];
        if (isset($request->paid_status)) {
            $paid_status = $request->paid_status;
            if ($paid_status == 1) { //1 = Paid
                $validator = ['price'   => 'required'];
                $price = $request->price;
            } else { //0 = Free
                $price = 0;
            }
        } else {
            $paid_status = 0;
            $price = 0;
        }
        $validator = Validator::make($request->all(), $validator);

        if ($validator->passes()) {
            EduAssignCoursePackage_Provider::create([
                'course_id'        => $request->course_id,
                'package_name'     => $request->package_name,
                'package_subtitle' => $request->package_subtitle,
                'paid_status'      => $paid_status,
                'price'            => $price,
                'duration'         => $request->duration,
                'package_type'     => $request->package_type
            ]);
            $output['messege'] = 'Assign Course has been created';
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
        $data['courses'] = EduCourses_Provider::valid()->latest()->get();
        $data['assign_package_info'] = EduAssignCoursePackage_Provider::valid()->find($id);
        return view('provider.assignPackage.update', $data);
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
        $validator = [
            'course_id'        => 'required',
            'package_type'     => 'required',
            'package_name'     => 'required',
            'package_subtitle' => 'required',
            'paid_status'      => 'required',
            'duration'         => 'required'
        ];
        if (isset($request->paid_status)) {
            $paid_status = $request->paid_status;
            if ($paid_status == 1) { //1 = Paid
                $validator = ['price'   => 'required'];
                $price = $request->price;
            } else { //0 = Free
                $price = 0;
            }
        } else {
            $paid_status = 0;
            $price = 0;
        }
        $validator = Validator::make($request->all(), $validator);

        if ($validator->passes()) {
            EduAssignCoursePackage_Provider::find($id)->update([
                'course_id'        => $request->course_id,
                'package_name'     => $request->package_name,
                'package_subtitle' => $request->package_subtitle,
                'paid_status'      => $paid_status,
                'price'            => $price,
                'duration'         => $request->duration,
                'package_type'     => $request->package_type
            ]);
            $output['messege'] = 'Assign Course has been updated';
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
        EduAssignCoursePackage_Provider::valid()->find($id)->delete();
    }

    public function packagePublish(Request $request)
    {
        $data['assign_package_id'] = $assign_package_id = $request->id;
        $data['assign_package_info'] = EduAssignCoursePackage_Provider::valid()->find($assign_package_id);
        return view('provider.assignPackage.packagePublish', $data);
    }
    public function packagePublishAction(Request $request)
    {
        $assign_package_id = $request->id;
        $validator = Validator::make($request->all(), [
            'publish_status'     => 'required'
        ]);
        if ($validator->passes()) {
            EduAssignCoursePackage_Provider::find($assign_package_id)->update(['publish_status' => $request->publish_status]);
            $output['messege'] = 'Package Publish Status has been Updated';
            $output['msgType'] = 'success';
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }
    // PACKAGE'S FEATURES 
    public function assignPackageFeatureList(Request $request)
    {
        $data['package_id'] = $request->package_id;
        $data['package_name'] = EduAssignCoursePackage_Provider::valid()->find($request->package_id)->package_name;
        $data['package_features'] = EduAssignPackageFeatures_Provider::valid()->where('assign_package_id', $request->package_id)->get();
        return view('provider.assignPackage.featureListData', $data);
    }
    public function packageFeature(Request $request)
    {
        $data['package_id'] = $request->package_id;
        $data['package_features'] = EduAssignPackageFeatures_Provider::valid()->where('assign_package_id', $request->package_id)->get();
        return view('provider.assignPackage.addFeature', $data);
    }
    public function packageFeatureAction(Request $request, $package_id)
    {
        $features_arr = $request->feature_title;
        $validator = Validator::make($request->all(), [
            'feature_title' => 'required',
        ]);

        if ($validator->passes()) {
            $filter_features_arr = array_filter($features_arr);
            foreach($filter_features_arr as $key => $video_id) 
            {
                EduAssignPackageFeatures_Provider::create([
                    'assign_package_id' => $package_id,
                    'feature_title'     => $video_id,
                ]);
            }

            $output['messege'] = 'Package Feature has been Added';
            $output['msgType'] = 'success';

            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    public function packageFeatureDelete($feature_id)
    {
        EduAssignPackageFeatures_Provider::valid()->find($feature_id)->delete();
    }
}
