<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function index()
    {
        return view('main'); // 'main'は、resources/views/main.blade.phpに対応
    }

    }