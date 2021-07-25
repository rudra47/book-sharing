<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use Validator;
use App\Models\EduBlog_Web;
use App\Models\EduBlogComment_web;

class BlogController extends Controller
{
    public function blogs()
    {
        $data['title'] = "Blog";
        $data['blogs'] = EduBlog_Web::valid()->paginate(5);
        $data['blogsForSideBar'] = EduBlog_Web::valid()->orderby('id', 'DESC')->take(5)->get();
        return view('web.blogs', $data);
    }
    public function blogDetails(Request $request)
    {
        $data['title'] = "Blog Details";
        $data['blog'] = EduBlog_Web::where('id', $request->id)->valid()->first();
        $data['blogsForSideBar'] = EduBlog_Web::valid()->orderby('id', 'DESC')->take(5)->get();
        $data['comments'] = EduBlogComment_web::join('users', 'users.id', '=', 'edu_blog_comments.created_by')  
            ->select('edu_blog_comments.*', 'users.name', 'users.image')
            ->where('edu_blog_comments.blog_id', $request->id)
            ->where('edu_blog_comments.status', 1)
            ->orderBy('id', 'DESC')
            ->get();
            
        return view('web.blogDetails', $data);
    }
    public function blogCommentAction(Request $request)
    {
        $output = array();
        $validator = Validator::make($request->all(), [
            'commentValue' => 'required',
        ]);
        if ($validator->passes()) {
            $data = EduBlogComment_web::create([
                'blog_id'   => $request->blogId,
                'comment'   => $request->commentValue
            ]);
            // $output['userData'] = EduBlogComment_web::join('users', 'users.id', '=', 'edu_blog_comments.created_by')  
            //     ->select('edu_blog_comments.*', 'users.name', 'users.image')
            //     ->where('edu_blog_comments.id', $data->id)
            //     ->first();
            
            $output['messege'] = 'Comment successfully';
            $output['msgType'] = 'success';
            $output['status'] = 1;
        } else {
            $output['messege'] = 'Failed! All Fields are Required';
            $output['msgType'] = 'danger';
            $output['status'] = 0;
        }
        return response($output);
    }            
}