<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateTask extends Component
{
    public $task_name;
    public $task_description;
    public $task_status;
    public $project_id;
    public $tasks;  
    public $editingTaskId;
    public $showModal = false;
    public $showModal2 = false;

    public $filter = 'all';  

 
    public $totalTasks;
    public $completedTasks;
    public $incomplete;
    public $inProgressTasks;

    protected $rules = [
        'task_name' => 'required|string|max:255',
        'task_description' => 'nullable|string',
        'task_status' => 'required|string|in:incomplete,in_progress,completed',
    ];

    public function mount($projectId)
    {
        $this->project_id = $projectId;
        $this->loadTasks(); 
    }

    public function createTask()
    {
        $this->validate();

        Task::create([
            'name' => $this->task_name,
            'description' => $this->task_description,
            'status' => $this->task_status,
            'project_id' => $this->project_id,
        ]);

        $this->resetInputFields();
        $this->loadTasks();
        $this->task_name = '';
        $this->task_description = '';
        $this->task_status = '';
        $this->editingTaskId = '';
        $this->showModal2 = false;
    }

    
    
    public function newtas()
    {
     
            $this->showModal2 = true;
    
    }
    
    
    public function editTask($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $this->task_name = $task->name;
            $this->task_description = $task->description;
            $this->task_status = $task->status;
            $this->editingTaskId = $task->id;
            $this->showModal = true;
        }
    }

    public function updateTask()
    {
        $this->validate();

        $task = Task::find($this->editingTaskId);
        if ($task) {
            $task->update([
                'name' => $this->task_name,
                'description' => $this->task_description,
                'status' => $this->task_status,
            ]);

            $this->resetInputFields();
            $this->loadTasks();
            $this->showModal = false;
        }
    }

    public function confirmDelete($taskId)
    {
        $this->dispatchBrowserEvent('confirm-delete', ['taskId' => $taskId]);
    }

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->delete();
            $this->resetInputFields();
            $this->loadTasks();
        }
    }

    public function loadTasks()
    {
        $this->tasks = Task::whereIn('project_id', function ($query) {
            $query->select('id')
                  ->from('projects')
                  ->where('user_id', Auth::id());
        })->orderBy('created_at', 'desc')->get();
    
        $this->countTasks();
    }

 
    public function countTasks()
    {
        $this->totalTasks = $this->tasks->count();
        $this->completedTasks = $this->tasks->where('status', 'completed')->count();
        $this->incomplete = $this->tasks->where('status', 'incomplete')->count();
        $this->inProgressTasks = $this->tasks->where('status', 'in_progress')->count();
    }

    public function resetInputFields()
    {
        $this->reset(['task_name', 'task_description', 'task_status', 'editingTaskId']);
    }

    public function render()
    {
        return view('livewire.create-task', [
            'tasks' => $this->tasks,
            'totalTasks' => $this->totalTasks,
            'completedTasks' => $this->completedTasks,
            'incomplete' => $this->incomplete,
            'inProgressTasks' => $this->inProgressTasks,
        ]);  
    }
}
