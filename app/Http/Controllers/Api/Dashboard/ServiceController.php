<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = Service::all();
        return response()->json($service);
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tools' => 'required|string|max:255',
        ]);
        $service = Service::create([
            'name'=>Purifier::clean($request->input('name')),
            'description'=>Purifier::clean($request->input('description')),
            'tools'=>Purifier::clean($request->input('tools')),
        ]);
        $service->save();
        $response = ['statu'=>'success',
        'messege'=>'service added successfully',
        'data'=>$service];
        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return response()->json($service,201);
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
    public function update(Request $request, Service $service)
    {
       $data = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'tools' => 'string|max:255',
        ]);
        /* $service->name = Purifier::clean($request->input('name'));
        $service->description = Purifier::clean($request->input('description'));
        $service->tools = Purifier::clean($request->input('tools')); */
        $service->update($data);
        $response = [
            'statu'=>'success',
            'messeg'=>'service updated successfully',
            'data'=>$service
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json([
            'statu'=>'success',
            'messege'=>'service deleted successfully'
        ],202);
    }
}
