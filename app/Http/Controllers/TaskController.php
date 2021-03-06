<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'tasklist_id' => 'required'
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
            'desc' => $request->desc,
            'tasklist_id' => $request->tasklist_id,
            'color' => $request->color
        ]);

        return redirect('/tasklists');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request $request
     * @param  Task $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasklists');
    }

    public function move(Request $request, Task $task)
    {
        $task->update(['tasklist_id' => $request->tasklist_id]);

        return redirect('/tasklists');
    }

    public function edit(Request $request, Task $task)
    {
        $task->update(['name' => $request->name, 'desc' => $request->desc, 'color' => $request->color]);

        return redirect('/tasklists');
    }
}
