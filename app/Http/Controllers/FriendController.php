<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
        $currentUserID = Auth::user()->id;
        $friendID = $request->input('friend_id');
        // dd($friendID);
        $request_id = $request->input('request_id');

        $friend = Friend::create([
            'user_id' => $currentUserID,
            'friend_id' => $friendID
        ]);

        $friend2 = Friend::create([
            'user_id' => $friendID,
            'friend_id' => $currentUserID
        ]);

        $updateRequest = FriendRequest::find($request_id);
        $updateRequest->status = 'accepted';
        $updateRequest->save();

        return redirect()->route('friend-request.index')->with('success', 'Friend is Made!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FriendRequest $friendRequest)
    {
        $deleteRequest = FriendRequest::destroy($friendRequest->id);

        return redirect()->route("friend-request.index")->with('success', 'Succesfully Delete');
    }
    // public function destroy(FriendRequest $friendRequest)
    // {
    //     $friend_request = $request->input('friend_request');
    //     $deleteRequest = FriendRequest::destroy($friendRequest->id);
    //     return redirect()->route("friend-request.index")->with('success', 'Succesfully Delete');
    // }
}
