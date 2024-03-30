<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Info::all();
        return response()->json($user);
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone'=>'required|string|min:10',
            'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048',
            'biography'=>'required|string',
            'address' => 'required|string',
        ]);
        
        $user = new Info();
        $user->firstname = Purifier::clean($request->input('firstname'));
        $user->lastname = Purifier::clean($request->input('lastname'));
        $user->email = auth()->user()->email;
        $user->phone = Purifier::clean($request->input('phone'));
        $user->biography = Purifier::clean($request->input('biography'));
        $user->address = Purifier::clean($request->input('address'));
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $user->image = $image_name;}
        $user->save();
        $response = [
            'status' => 'success',
            'message' => 'info is created successfully',
            'data' => [
                'user' => $user,
            ],
        ];
        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Info $info)
    {
        return response()->json($info,201);
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
    public function update(Request $request, Info $user)
    {
        $data = Purifier::clean($request->validate([
        'firstname' => 'max:255',
        'lastname' => 'max:255',
        'phone'=>'string|min:10',
        'image'=>'image|Mimes:jpeg,png,jpg,gif|max:2048',
        'biography'=>'string',
        'address' => 'string',
       ]));
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $user->image = $image_name;}
        $user->update($data);
        $response = [
            'status' => 'success',
            'message' => 'info is updated successfully',
            'data' => $user,
        ];
        return response()->json($response,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        $info->delete();
        return response()->json([
            'statu'=>'success',
            'messege'=>'info deleted successfully'
        ],202);
    }
}