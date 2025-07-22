<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function create()
    {
        return view('admin.job.create_job');
    }
}

