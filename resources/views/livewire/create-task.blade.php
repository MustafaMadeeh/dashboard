<div>
<div >
 

    
    <div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Tasks  

<button onclick="shownew()" class="flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        New Task 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16">
<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
</svg>


                    </button></h2>


    <div class="fixed z-10 inset-0 overflow-y-auto {{ $showModal2 ? '' : 'hidden' }}">
    <div class="flex items-center justify-center min-h-screen">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-gray-50 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Task</h3>
                        <div class="mt-2">
                            <form wire:submit.prevent="createTask">
                                <div class="mb-4">
                                    <label for="taskName" class="block text-sm font-medium text-gray-700">Task Name</label>
                                    <input type="text" id="taskName" wire:model="task_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div class="mb-4">
                                    <label for="taskDescription" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea id="taskDescription" wire:model="task_description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="taskStatus" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="taskStatus" wire:model="task_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
                                    <option value="completed">Completed</option>
                                        <option value="incomplete">incomplete</option>
                                  
                                        
                                    </select>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" wire:click="$set('showModal2', false)" class="mr-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-150 ease-in-out">Cancel</button>
                                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out">Create Task</button>
                                </div>
                            </form>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>



 

    <div>
    <div class="flex justify-center flex-wrap gap-4">
        <button wire:click="$set('filter', 'all')" class="bg-indigo-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 focus:outline-none text-sm min-w-[120px]">
            <h3 class="font-semibold">Total Tasks {{ $totalTasks }}</h3>
        </button>
        <button wire:click="$set('filter', 'completed')" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 focus:outline-none text-sm min-w-[120px]">
            <h3 class="font-semibold">Completed Tasks {{ $completedTasks }} </h3>
        </button> 
        <button wire:click="$set('filter', 'incomplete')" class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none text-sm min-w-[120px]">
            <h3 class="font-semibold">incomplete {{ $incomplete }}</h3>
        </button>
  
    </div>

        @if ($filter === 'all')  
        
        <h2 class="text-2xl font-bold text-gray-800 mb-4">All Tasks</h2>
 
        <ul class="mt-4 space-y-4">
            @foreach($tasks as $task)
                <li class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md border border-gray-200">
                    <div>
                        <strong class="text-lg text-gray-800">{{ $task->name }}</strong>
                        <p class="text-gray-500">{{ $task->description }}</p>
                        <span class="text-sm {{ $task->status == 'incomplete' ? 'text-yellow-500' : ($task->status == 'in_progress' ? 'text-blue-500' : 'text-green-500') }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="EditTask({{ $task->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Edit 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button onclick="confirmDelete({{ $task->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Delete
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </li>

              

            @endforeach
            </ul>
    @elseif ($filter === 'completed')
        <h3 class="mt-6 text-xl font-bold">Completed Tasks</h3>
        <ul class="mt-4 space-y-4">
            @foreach ($tasks->where('status', 'completed') as $task)
       
      
                <li class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md border border-gray-200">
                    <div>
                        <strong class="text-lg text-gray-800">{{ $task->name }}</strong>
                        <p class="text-gray-500">{{ $task->description }}</p>
                        <span class="text-sm {{ $task->status == 'incomplete' ? 'text-yellow-500' : ($task->status == 'in_progress' ? 'text-blue-500' : 'text-green-500') }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="EditTask({{ $task->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Edit 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button onclick="confirmDelete({{ $task->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Delete
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </li>

              

            @endforeach
            </ul>
    @elseif ($filter === 'incomplete')
        <h3 class="mt-6 text-xl font-bold">incomplete Tasks</h3>
        <ul class="mt-4 space-y-4">
            @foreach ($tasks->where('status', 'incomplete') as $task)
       
      
                <li class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md border border-gray-200">
                    <div>
                        <strong class="text-lg text-gray-800">{{ $task->name }}</strong>
                        <p class="text-gray-500">{{ $task->description }}</p>
                        <span class="text-sm {{ $task->status == 'incomplete' ? 'text-yellow-500' : ($task->status == 'in_progress' ? 'text-blue-500' : 'text-green-500') }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="EditTask({{ $task->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Edit 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button onclick="confirmDelete({{ $task->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Delete
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </li>

              

            @endforeach
            </ul>
    @elseif ($filter === 'in_progress')
        <h3 class="mt-6 text-xl font-bold">In Progress Tasks</h3>
        <ul class="mt-4 space-y-4">
            @foreach ($tasks->where('status', 'in_progress') as $task)
       
      
                <li class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md border border-gray-200">
                    <div>
                        <strong class="text-lg text-gray-800">{{ $task->name }}</strong>
                        <p class="text-gray-500">{{ $task->description }}</p>
                        <span class="text-sm {{ $task->status == 'incomplete' ? 'text-yellow-500' : ($task->status == 'in_progress' ? 'text-blue-500' : 'text-green-500') }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="EditTask({{ $task->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Edit 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <button onclick="confirmDelete({{ $task->id }})" class="flex items-center px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Delete
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </li>

              

            @endforeach
            </ul>
    @endif
</div>
        


        @if($tasks->isEmpty())
            <p class="text-gray-500 mt-2">No tasks available for this project.</p>
        @endif
    </div>

 
    <div class="fixed z-10 inset-0 overflow-y-auto {{ $showModal ? '' : 'hidden' }}">
    <div class="flex items-center justify-center min-h-screen">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-gray-50 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Task</h3>
                        <div class="mt-2">
                            <form wire:submit.prevent="updateTask">
                                <div class="mb-4">
                                    <label for="editTaskName" class="block text-sm font-medium text-gray-700">Task Name</label>
                                    <input type="text" id="editTaskName" wire:model="task_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" required>
                                </div>
                                <div class="mb-4">
                                    <label for="editTaskDescription" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea id="editTaskDescription" wire:model="task_description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="editTaskStatus" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="editTaskStatus" wire:model="task_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
                                   
                                        <option value="completed">Completed</option>
                                        <option value="incomplete">Not Completed</option>
                                    
                                    </select>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" wire:click="$set('showModal', false)" class="mr-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-150 ease-in-out">Cancel</button>
                                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out">Update Task</button>
                                </div>
                            </form>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>

    </div>

    <script>




function shownew() {
        @this.newtas(); 

    }
    function EditTask(taskId) {
        @this.editTask(taskId); 
    }

    function confirmDelete(taskId) {
        if (confirm("Are you sure you want to delete this Task?")) {
            @this.deleteTask(taskId); 
        }
    }
    </script>
</div>
