<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review = Review::all();
        return response()->json($review);
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
            'email'=>'required|email:unique',
            'description'=>'required'
        ]);
        $review = Review::create([
            'email'=>Purifier::clean($request->input('email')),
            'description'=>Purifier::clean($request->input('description')),
        ]);
        $review->save();
        return response()->json(['messege'=>'review added successfully'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return response()->json($review,200);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
