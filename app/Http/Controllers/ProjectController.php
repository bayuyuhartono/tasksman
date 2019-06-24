<?php

namespace App\Http\Controllers;

use App;
use App\Project;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')
            ->withCount(['tasks'])
            ->get();

        return $projects->toJson();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'cvrimg' => 'required',
            'description' => 'required',
        ]);

        // $request->cvrimg_filename = url('file/cvrimg/nopic.jpg');
        // if ($request->hasFile('cvrimg')) {
        // if ($request->file('cvrimg')->isValid()) {
        $extension = $request->cvrimg->extension();
        $filename = 'cvrimg-' . $validatedData['name'] . rand(1111, 9999) . '.' . $extension;
        $file = $request->file('cvrimg');
        $file->move('file/cvrimg/', $filename);
        $request->cvrimg_filename = url('file/cvrimg/' . $filename);
        // }
        // }

        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'img_cover' => $request->cvrimg_filename,
        ]);

        return response()->json('Project created!');
    }

    public function show($id)
    {
        $project = Project::with(['tasks'])->find($id);

        return $project->toJson();
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $nama = $validatedData['name'];
        $des = $validatedData['description'];

        $project = Project::find($id);
        $project->name = $nama;
        $project->description = $des;
        $project->save();

        return response()->json('Project updated!');
    }
}
