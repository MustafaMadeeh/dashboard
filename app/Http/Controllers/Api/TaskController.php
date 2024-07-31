<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
  
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
        ]);

     
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'not complete',  
            'project_id' => $request->project_id,
        ]);

        return response()->json($task, 201); 
    }

    /**
 
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

 
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }

    /**
 
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
      
        $request->validate([
            'status' => 'required|string|in:complete,not complete', 
        ]);

        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

     
        $task->status = $request->status;
        $task->save();

        return response()->json(['message' => 'Task status updated successfully', 'task' => $task]);
    }
}
