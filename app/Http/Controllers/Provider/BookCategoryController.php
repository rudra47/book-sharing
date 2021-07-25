<?php

namespace App\Http\Controllers\Provider;

use File;
use Helper;
use Validator;
use Illuminate\Http\Request;
use App\Models\BookCategory_provider;
use App\Http\Controllers\Controller;
use App\Models\EduTeachers_Provider;
use App\Models\EduAssignCourseTeachers_Provider;

class BookCategoryController extends Controller
{
    public function index()
    {
        $data['bookCategories'] = BookCategory_provider::valid()->latest()->get();
        return view('provider.bookCategory.listData', $data);
    }

    public function create()
    {
        return view('provider.bookCategory.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required'
        ]);
        if ($validator->passes()) {
            BookCategory_provider::create([
                'name' => $request->name
            ]);
            $output['messege'] = 'Category has been created';
            $output['msgType'] = 'success';
            
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
        $data['bookCategory'] = BookCategory_provider::valid()->find($id);
        return view('provider.bookCategory.update', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->passes()) {
            BookCategory_provider::find($id)->update([
                'name' => $request->name
            ]);
            $output['messege'] = 'Category has been updated';
            $output['msgType'] = 'success';
        
            return redirect()->back()->with($output);
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    public function destroy($id)
    {
        BookCategory_provider::valid()->find($id)->delete();
    }
}
