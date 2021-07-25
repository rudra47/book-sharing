<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EduBlog_Provider;
use Validator;
use Auth;
use Helper;
use File;

class BlogController extends Controller
{
    public function index()
    {
        $data['all_blogs'] = EduBlog_Provider::valid()->orderBy('id', 'desc')->get();
        return view('provider.blog.listData', $data);
    }

    public function create()
    {
        return view('provider.blog.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'description' => 'required',
            'image'    => 'required',
        ]);

        if ($validator->passes()) {
            $mainFile = $request->image;
            $imgPath = 'uploads/blog';
            $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 640, 426);
            
            if ($uploadResponse['status'] == 1) {
                EduBlog_Provider::create([
                    'title'           => $request->title,
                    'description'     => $request->description,
                    'image'           => $uploadResponse['file_name'],
                    'status'          => $request->status ? $request->status : 0
                ]);
                $output['messege'] = 'Blog has been created';
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['blog'] = EduBlog_provider::valid()->find($id);
        return view('provider.blog.update', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            // 'image'    => 'required',
            'description' => 'required'
        ]);
        if ($validator->passes()) {
            $blog = EduBlog_provider::find($id);
            if (isset($request->image)) {
                if ($request->image != $blog->image) {
                    $mainFile = $request->image;
                    $imgPath = 'uploads/blog';
                    $uploadResponse = Helper::getUploadedFileName($mainFile, $imgPath, 640, 426);
                    
                    if ($uploadResponse['status'] == 1) {
                        File::delete(public_path($imgPath.'/').$blog->image);
                        File::delete(public_path($imgPath.'/thumb/').$blog->image);
                        
                        $blog->update([
                            'title'       => $request->title,
                            'image'       => $uploadResponse['file_name'],
                            'description' => $request->description,
                            'status'      => $request->status ? $request->status : 0
                        ]);
                        $output['messege'] = 'Blog has been updated';
                        $output['msgType'] = 'success';
                    } else {
                        $output['messege'] = $uploadResponse['errors'];
                        $output['msgType'] = 'danger';
                    }
                } else {
                    $blog->update([
                        'title'      => $request->title,
                        'description'=> $request->description,
                        'status'     => $request->status ? $request->status : 0
                    ]);
                    $output['messege'] = 'Blog has been updated';
                    $output['msgType'] = 'success';
                }
            } else {
                $blog->update([
                    'title'       => $request->title,
                    'description' => $request->description,
                    'status' => $request->status ? $request->status : 0
                ]);
                $output['messege'] = 'Blog has been updated';
                $output['msgType'] = 'success';
            }
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    public function destroy($id)
    {
        $blog = EduBlog_provider::valid()->find($id);
        File::delete(public_path('uploads/blog/').$blog->image);
        File::delete(public_path('uploads/blog/thumb/').$blog->image);
        EduBlog_provider::valid()->find($id)->delete();
    }
}
