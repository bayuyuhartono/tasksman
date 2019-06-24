<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'username' => 'required',
        ]);

        $task = Task::create([
            'title' => $validatedData['title'],
            'username' => $validatedData['username'],
            'project_id' => $request->project_id,
        ]);

        return $task->toJson();
    }
}
