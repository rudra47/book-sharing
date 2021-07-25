<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EduBlog_Provider;
use App\Models\EduBlogComment_provider;
use Validator;
use Auth;
use Helper;
use File;

class BlogCommentController extends Controller
{
    public function commentList($blogId)
    {
        $data['comments'] = EduBlogComment_provider::join('users', 'users.id', '=', 'edu_blog_comments.created_by')  
            ->select('edu_blog_comments.*', 'users.name')
            ->where('edu_blog_comments.blog_id', $blogId)
            ->where('edu_blog_comments.valid', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('provider.blog.blogComments.listData', $data);
    }
    public function commentPublish($commentId)
    {
        $data['commentId'] = $commentId;
        $data['comment'] = EduBlogComment_provider::valid()->find($commentId);
        return view('provider.blog.blogComments.commentPublish', $data);
    }
    public function commentPublishAction(Request $request, $commentId)
    {
        $validator = Validator::make($request->all(), [
            'publish_status'     => 'required'
        ]);
        if ($validator->passes()) {
            EduBlogComment_provider::find($commentId)->update(['status' => $request->publish_status]);
            $output['messege'] = 'Comment Status has been Updated';
            $output['msgType'] = 'success';
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

}
