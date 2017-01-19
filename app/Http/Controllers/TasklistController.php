<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TasklistRepository;

class TasklistController extends Controller
{
    protected $tasklists;

    public function __construct(TasklistRepository $tasklists)
    {
        $this->middleware('auth');

        $this->tasklists = $tasklists;
    }

    public function index(Request $request)
    {
        return view('tasklists.index', [
            'tasklists' => $this->tasklists->forUser($request->user()),
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

    public function destroy(Request $request, TaskList $tasklist)
    {
        $this->authorize('destroy', $tasklist);

        $tasklist->delete();

        return redirect('/tasklists');
    }
}
