<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForTutorsController extends Controller
{
    public function index()
    {
        return view('for-tutors');
    }
}
