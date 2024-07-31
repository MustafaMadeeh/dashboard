<div>


<h1 class="text-2xl font-semibold mb-4">
<span class="flex items-center">
        Projects 
        <span class="ml-2 inline-flex items-center justify-center w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 font-semibold text-sm">
            {{ $projectCount }}
        </span>
 
     <button id="openModal"  class=" mx-3 inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10"> Create New Project <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" width="16" height="16" className="size-6">
  <path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>
</button>   </span>
                    </h1>




    <div id="createProjectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full {{ $showModal ? '' : 'hidden' }}">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-lg font-bold">{{ $editingProjectId ? 'Edit Project' : 'New Project' }}</h5>
                    <button id="closeModal" class="text-gray-400 hover:text-gray-600" onclick="closeModal()">
                        &times;  
                    </button>
                </div>
                <form id="createProjectForm" wire:submit.prevent="saveProject">
                    <div class="mb-4">
                        <label for="projectName" class="block text-sm font-medium">Project Name</label>
                        <input type="text" id="projectName" wire:model="projectName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="projectDescription" class="block text-sm font-medium">Description</label>
                        <textarea id="projectDescription" wire:model="projectDescription" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 text-black" required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2" onclick="closeModal()">Close</button>
                        <button type="submit" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{ $editingProjectId ? 'Update Project' : 'Create Project' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="py-12">
    <h5 class="text-lg font-bold mt-8 text-gray-900 dark:text-white">Existing Projects</h5>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
        @foreach($projects as $project)
            <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-4 flex flex-col justify-between">
                <div>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $project->project_name }}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $project->project_description }}</span>
                </div>
                <div class="flex justify-between mt-4 space-x-2">


   <a href="projectdata/{{ $project->id }}" class="flex items-center px-3 py-1 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
    View Tasks
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 ml-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16 12h2a2 2 0 01-2 2v-2zm-4 0h-2a2 2 0 012-2v2zm4-4h2a2 2 0 01-2 2V8zm-4 0h-2a2 2 0 012-2v2zm0 8h2a2 2 0 01-2 2v-2zm-4 0h-2a2 2 0 012-2v2zm-2-8H8a2 2 0 012-2v2zm0 4H8a2 2 0 012-2v2z" />
    </svg>
</a>

                    <button wire:click="editProject({{ $project->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Edit
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                    </button>
                    <button onclick="confirmDelete({{ $project->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Delete
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </div>
            
        @endforeach
    </div>
</div>

<script>
    function confirmDelete(projectId) {
        if (confirm("sure you want to delete this project?")) {
            @this.deleteProject(projectId);  
        }
    }
</script>




    
    <script>
    document.getElementById('openModal').addEventListener('click', function () {
 document.getElementById('projectName').value = '';
  document.getElementById('projectDescription').value = '';
   document.getElementById('createProjectModal').classList.remove('hidden');

      });
function closeModal() {

     

    document.getElementById('projectName').value = '';
  document.getElementById('projectDescription').value = '';
  document.getElementById('createProjectModal').classList.add('hidden');
 
}
      function submitProject() {
          const form = document.getElementById('createProjectForm');
          closeModal();
      }
  </script>




</div>

 

  