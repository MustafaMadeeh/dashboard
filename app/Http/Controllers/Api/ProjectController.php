<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $projects = Project::where('user_id', $user->id)->get();
            return response()->json($projects);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
 
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
 
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_description' => 'required|string',
        ]);

     
        $project = Project::create([
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'user_id' => $request->user()->id,  
            'is_completed' => false,
        ]);

        return response()->json($project, 201);  
    }

    /**
 
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
    
        $project = Project::where('id', $id)->where('user_id', $request->user()->id)->first();

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

 
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
