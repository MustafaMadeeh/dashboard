<x-app-layout>
    <div class="container mx-auto p-6">


    <div class="m-4">
    <h1 class="text-3xl font-bold text-gray-800">{{ $project->project_name }}</h1>
        <p class="text-gray-600 mt-2">{{ $project->project_description }}</p>

    </div>
        @livewire('create-task', ['projectId' => $project->id])
 
             
        </div>

        <script>

        </script>
    </div>
</x-app-layout>
