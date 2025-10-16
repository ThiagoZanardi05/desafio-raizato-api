<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;   
use App\Http\Requests\UpdateTaskRequest;  
use App\Http\Requests\ListTasksRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListTasksRequest $request)
    {
        $validated = $request->validated();

        $tasksQuery = Task::query();

        if (isset($validated['status'])) {
            $tasksQuery->where('status', $validated['status']);
        }

        $sortBy = $validated['sort_by'] ?? 'created_at';
        $sortDir = $validated['sort_dir'] ?? 'desc';
        $tasksQuery->orderBy($sortBy, $sortDir);

        $perPage = $validated['per_page'] ?? 10;
        $tasks = $tasksQuery->paginate($perPage);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
{
        $task = Task::create($request->validated());

        return (new TaskResource($task))
                ->response()
                ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
     
        $task->update($request->validated());

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(null, 204);
    }
}
