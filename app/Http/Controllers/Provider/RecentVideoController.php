<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EduRecentVideo_Provider;
use Validator;
use Helper;

class RecentVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_videos'] = EduRecentVideo_Provider::valid()->orderBy('id', 'desc')->get();
        return view('provider.recentVideo.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.recentVideo.create');
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
            'video_id' => 'required'
        ]);
        if ($validator->passes()) {
            $video_title = Helper::getYoutubeVideoTitle($request->video_id);
            EduRecentVideo_Provider::create([
                'video_id'    => $request->video_id,
                'video_title' => $video_title,
                'status'      => isset($request->status) ? $request->status : 0
            ]);
            $output['messege'] = 'Recent Video has been created';
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
        $data['video_info'] = EduRecentVideo_Provider::valid()->find($id);
        return view('provider.recentVideo.update', $data);
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
            'video_id' => 'required'
        ]);
        if ($validator->passes()) {
            $videoInfo = EduRecentVideo_Provider::find($id);
            if ($request->video_id != $videoInfo->video_id) {
                $video_title = Helper::getYoutubeVideoTitle($request->video_id);
            } else {
                $video_title = $videoInfo->video_title;
            }
            EduRecentVideo_Provider::find($id)->update([
                'video_id'    => $request->video_id,
                'video_title' => $video_title,
                'status'      => isset($request->status) ? $request->status : 0
            ]);
            $output['messege'] = 'Recent Video has been updated';
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
        EduRecentVideo_Provider::valid()->find($id)->delete();
    }
}
