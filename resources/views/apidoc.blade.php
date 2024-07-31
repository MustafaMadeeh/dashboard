
<x-app-layout>


<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-center mb-6">API Documentation</h1>

    <div class="mb-4 p-4 border-l-4 border-indigo-500 bg-indigo-50">
        <h2 class="text-xl font-bold">/api/login</h2>
        <p class="mt-2">Request Body:</p>
        <pre class="bg-gray-100 p-2 rounded">
{
    "email": "user@example.com",
    "password": "your_password"
}
        </pre>
    </div>

    <hr class="my-6">

    <div class="mb-4 p-4 border-l-4 border-indigo-500 bg-indigo-50">
        <h2 class="text-xl font-bold">/api/logout</h2>
    </div>

    <hr class="my-6">

    <div class="mb-4 p-4 border-l-4 border-indigo-500 bg-indigo-50">
        <h2 class="text-xl font-bold">/api/projects</h2>
        <p class="mt-2">Request Body:</p>
        <pre class="bg-gray-100 p-2 rounded">
{
    "project_name": "New Project",
    "project_description": "Description of the new project"
}
        </pre>
    </div>

    <hr class="my-6">

    <div class="mb-4 p-4 border-l-4 border-indigo-500 bg-indigo-50">
        <h2 class="text-xl font-bold">/api/projects/{id}</h2>
        <p class="mt-2">DELETE Request to delete project</p>
    </div>

    <hr class="my-6">

    <div class="mb-4 p-4 border-l-4 border-indigo-500 bg-indigo-50">
        <h2 class="text-xl font-bold">/api/tasks</h2>
        <p class="mt-2">Request Body:</p>
        <pre class="bg-gray-100 p-2 rounded">
{
    "name": "New Task",
    "description": "Description of the new task",
    "project_id": 1
}
        </pre>
    </div>

    <hr class="my-6">

    <div class="mb-4 p-4 border-l-4 border-indigo-500 bg-indigo-50">
        <h2 class="text-xl font-bold">/api/tasks/{id}</h2>
        <p class="mt-2">DELETE Request to delete task</p>
    </div>

    <hr class="my-6">

    <div class="mb-4 p-4 border-l-4 border-indigo-500 bg-indigo-50">
        <h2 class="text-xl font-bold">/api/tasks/{id}/status</h2>
        <p class="mt-2">Request Body:</p>
        <pre class="bg-gray-100 p-2 rounded">
{
    "status": "complete" or "not complete"
}
        </pre>
    </div>
</div>



</x-app-layout>
