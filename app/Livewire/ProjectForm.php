<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;

class ProjectForm extends Component
{
    public $projectName;
    public $projectDescription;
    public $projects;
    public $editingProjectId;
    public $showModal = false;  
    public $projectCount;
    public function mount()
    {
        $this->loadProjects();
    }



    public function viewTasks($projectId)
{ 
    $this->tasks = Task::where('task_to', $projectId)->get();
    $this->showTasksModal = true;  
}






    public function saveProject()
    {
        $this->validate([
            'projectName' => 'required|string|max:255',
            'projectDescription' => 'required|string',
        ]);

        if ($this->editingProjectId) {
            $project = Project::find($this->editingProjectId);
            $project->update([
                'project_name' => $this->projectName,
                'project_description' => $this->projectDescription,
            ]);
        } else {
            Project::create([
                'project_name' => $this->projectName,
                'project_description' => $this->projectDescription,
                'user_id' => Auth::id(),
                'is_completed' => false,
            ]);
        }

        $this->resetFields();
        $this->loadProjects();
    }

    public function editProject($projectId)
    {
        $project = Project::find($projectId);
        if ($project) {
            $this->editingProjectId = $projectId;
            $this->projectName = $project->project_name;  
            $this->projectDescription = $project->project_description; 
            $this->showModal = true;  
        }
    }
    

    public function deleteProject($projectId)
    {
        $project = Project::find($projectId);
        if ($project) {
            $this->resetFields();
            $project->delete();
            $this->loadProjects();
        }
    }

    public function loadProjects()
    {
       // $this->projects = Project::all();
        $this->projects = Project::where('user_id', Auth::id())->get();
        $this->projectCount = Project::where('user_id', Auth::id())->count();
      

    }

    public function resetFields()
    {
        $this->projectName = '';
        $this->projectDescription = '';
        $this->editingProjectId = null;  
        $this->showModal = false;  
    }
    

    public function render()
    {
        return view('livewire.project-form');
    }
}
