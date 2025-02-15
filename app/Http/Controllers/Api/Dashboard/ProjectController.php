<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::all();
        return response()->json($project);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'description'=>'required',
            'project_link'=>'required|max:255',
            'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);
        $project = new Project();
        $project->title = Purifier::clean($request->input('title'));
        $project->description = Purifier::clean($request->input('description'));
        $project->project_link = Purifier::clean($request->input('project_link'));
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $project->image = $image_name;}
        $project->save();
        $response = [
            'statue' => 'success',
            'messege' => 'project added successfully',
            'data' => $project
        ];
        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {   
        return response()->json($project,201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'=>'string|max:255',
            'description'=>'text',
            'project_link'=>'max:255',
            'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048',
            
        ]);
        /* $project->title = $project->firstname = Purifier::clean($request->input('title'));
        $project->description = $project->firstname = Purifier::clean($request->input('description'));
        $project->project_link = $project->firstname = Purifier::clean($request->input('project_link')); */
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $project->image = $image_name;}
        $project->update($data);
        $response = [
            'statue' => 'success',
            'messege' => 'project updated successfully',
            'data' => $project
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['statue'=>'success',
        'messege'=>'project deleted successfully'],202);
    }
}
