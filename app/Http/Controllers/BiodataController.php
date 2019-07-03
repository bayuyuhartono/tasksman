<?php

namespace App\Http\Controllers;

use App;
use App\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'nickname' => 'required',
        ]);

        $biodata = Biodata::create([
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'nickname' => $validatedData['nickname'],
        ]);

        return response()->json('Biodata created!');
    }

    public function show($id)
    {
        $bio = Biodata::find($id);

        return $bio->toJson();
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'nickname' => $validatedData['nickname'],
        ]);

        $id = $validatedData['id'];
        $name = $validatedData['name'];
        $nickname = $validatedData['nickname'];

        $biodata = Biodata::find($id);
        $biodata->id = $id;
        $biodata->name = $name;
        $biodata->nickname = $nickname;
        $biodata->save();

        return response()->json('Biodata updated!');
    }
}
