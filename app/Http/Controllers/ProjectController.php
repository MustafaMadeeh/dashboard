<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show($id)
    {
        $project = Project::with('tasks')->findOrFail($id);


        return view('projectdata', ['project' => $project]);   
    }
}
