<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EduStudentReview_Provider;
use Validator;
use Auth;

class StudentReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_reviews'] = EduStudentReview_Provider::valid()->orderBy('id', 'desc')->get();
        return view('provider.studentReview.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.studentReview.create');
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
            'student_name' => 'required',
            'review'       => 'required'
        ]);
        if ($validator->passes()) {
            EduStudentReview_Provider::create([
                'student_name' => $request->student_name,
                'review'       => $request->review,
                'status'       => isset($request->status) ? $request->status : 0
            ]);
            $output['messege'] = 'Review has been created';
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
        $data['review'] = EduStudentReview_Provider::valid()->find($id);
        return view('provider.studentReview.update', $data);
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
            'student_name' => 'required',
            'review'       => 'required'
        ]);
        if ($validator->passes()) {
            EduStudentReview_Provider::find($id)->update([
                'student_name' => $request->student_name,
                'review'       => $request->review,
                'status'       => isset($request->status) ? $request->status : 0
            ]);
            $output['messege'] = 'Review has been updated';
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
        EduStudentReview_Provider::valid()->find($id)->delete();
    }
}
