<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class AboutUsController extends Controller
{
    public function aboutUs()
    {
        $data['title'] = "About Us";
        return view('web.aboutUs', $data);
    }
}
