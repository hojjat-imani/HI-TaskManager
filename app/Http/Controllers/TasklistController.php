<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tasklist;
use App\Repositories\TasklistRepository;

class TasklistController extends Controller
{
    protected $tasklists;
    protected $tasks;

    public function __construct(TasklistRepository $tasklists, TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasklists = $tasklists;
        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        return view('tasklists.index', [
            'tasklists' => $this->tasklists->forUser($request->user()),
            'tasks' => $this->tasks->forUser($request->user())
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasklists()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasklists');
    }

    public function destroy(Request $request, Tasklist $tasklist)
    {
        $tasklist->delete();

        return redirect('/tasklists');
    }
}
