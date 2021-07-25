<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $data['title'] = "FAQ";
        return view('web.faq');
    }
}
