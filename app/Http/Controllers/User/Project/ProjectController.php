<?php

namespace App\Http\Controllers\User\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show($slug)
    {
        $data = \App\Models\Project::where('slug', $slug)->first();
        return view('pages.user.project.index', compact('data'));
    }
}
