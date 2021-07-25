<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EduPhotoGallery_Provider;
use Validator;
use Helper;
use File;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_photos'] = EduPhotoGallery_Provider::valid()->orderBy('id', 'desc')->get();
        return view('provider.photoGallery.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.photoGallery.create');
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
            'image_name' => 'required'
        ]);
        if ($validator->passes()) {
            $mainFile = $request->image_name;
            $imgPath = 'uploads/photoGallery';
            $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 800, 600);
            if ($uploadResponse['status'] == 1) {
                EduPhotoGallery_Provider::create([
                    'image_name' => $uploadResponse['file_name'],
                    'status'     => isset($request->status) ? $request->status : 0
                ]);
                $output['messege'] = 'Photo Gallery has been created';
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
        $data['photoGallery'] = EduPhotoGallery_Provider::valid()->find($id);
        return view('provider.photoGallery.update', $data);
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
            // 'image_name' => 'required'
        ]);
        if ($validator->passes()) {
            $workflow = EduPhotoGallery_Provider::find($id);
            if (isset($request->image_name)) {
                if ($request->image_name != $workflow->image_name) {
                    $mainFile = $request->image_name;
                    $imgPath = 'uploads/photoGallery';
                    $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 800, 600);
                    
                    if ($uploadResponse['status'] == 1) {
                        File::delete(public_path($imgPath.'/').$workflow->image_name);
                        File::delete(public_path($imgPath.'/thumb/').$workflow->image_name);
                        
                        EduPhotoGallery_Provider::find($id)->update([
                            'image_name' => $uploadResponse['file_name'],
                            'status'     => isset($request->status) ? $request->status : 0
                        ]);
                        $output['messege'] = 'Photo Gallery has been updated';
                        $output['msgType'] = 'success';
                    } else {
                        $output['messege'] = $uploadResponse['errors'];
                        $output['msgType'] = 'danger';
                    }
                } else {
                    EduPhotoGallery_Provider::find($id)->update([
                        'status'     => isset($request->status) ? $request->status : 0
                    ]);
                    $output['messege'] = 'Photo Gallery has been updated';
                    $output['msgType'] = 'success';
                }
            } else {
                EduPhotoGallery_Provider::find($id)->update([
                    'status'     => isset($request->status) ? $request->status : 0
                ]);
                $output['messege'] = 'Photo Gallery has been updated';
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
        $workflow = EduPhotoGallery_Provider::valid()->find($id);
        File::delete(public_path('uploads/photoGallery/').$workflow->image_name);
        File::delete(public_path('uploads/photoGallery/thumb/').$workflow->image_name);
        EduPhotoGallery_Provider::valid()->find($id)->delete();
    }
}
