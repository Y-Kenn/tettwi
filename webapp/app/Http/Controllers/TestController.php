<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function sindex (Request $request)
    {
        $referer = url()->previous();
//        $referer = $request->header();
//        $referer = $request->all();
        return print_r($referer,true);
    }

    public function index()
    {
        return view('test');
    }

    public function next()
    {
        return view('next');
    }
}
