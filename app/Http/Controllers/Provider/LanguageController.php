<?php

namespace App\Http\Controllers\Provider;

use File;
use Helper;
use Validator;
use Illuminate\Http\Request;
use App\Models\Language_provider;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function index()
    {
        $data['languages'] = Language_provider::valid()->latest()->get();
        return view('provider.language.listData', $data);
    }

    public function create()
    {
        return view('provider.language.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required'
        ]);
        if ($validator->passes()) {
            Language_provider::create([
                'name' => $request->name
            ]);
            $output['messege'] = 'Language has been created';
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
        $data['language'] = Language_provider::valid()->find($id);
        return view('provider.language.update', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->passes()) {
            Language_provider::find($id)->update([
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
        Language_provider::valid()->find($id)->delete();
    }
}
