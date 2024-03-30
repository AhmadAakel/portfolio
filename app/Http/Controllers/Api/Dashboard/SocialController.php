<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social = Social::all();
        return response()->json($social);
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
            'title' => 'required|string|max:255',
            'link' => 'required|string',
        ]);
        $social = Social::create([
            'title'=>Purifier::clean($request->input('title')),
            'link'=>Purifier::clean($request->input('link')),
        ]);
        $social->save();
        $response = ['statu'=>'success',
        'messege'=>'social added successfully',
        'data'=>$social];
        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        //
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
    public function update(Request $request, Social $social)
    {
        $data = $request->validate([
            'title' => 'string|max:255',
            'link' => 'string',
        ]);
       /*  $social->title = Purifier::clean($request->input('title'));
        $social->link = Purifier::clean($request->input('link')); */
        $social->update($data);
        $response = [
            'statu'=>'success',
            'messeg'=>'social updated successfully',
            'data'=>$social
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Social $social)
    {
        $social->delete();
        return response()->json([
            'statu'=>'success',
            'messege'=>'social deleted successfully'
        ],202);
    }
}
