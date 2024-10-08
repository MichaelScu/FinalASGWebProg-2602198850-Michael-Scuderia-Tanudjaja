<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserID = Auth::user()->id;

        // Subquery to get the list of users who have sent a request to the current user
        $sentRequestUserIDs = DB::table('friend_requests')
            ->where('sender_id', '=', $currentUserID)
            ->pluck('receiver_id');

        // Subquery to get the list of users who have sent is already friends
        $friendUserIDs = DB::table('friends')
            ->where('user_id', '=', $currentUserID)
            ->pluck('friend_id');

        // Query to get users who have not sent a friend request to the current user
        $dataUser = User::join('friend_requests', 'users.id', '=', 'friend_requests.sender_id')
            ->where('friend_requests.receiver_id', '!=', $currentUserID)
            ->whereNotIn('users.id', $sentRequestUserIDs)
            ->join('friends', 'users.id', '=', 'friends.friend_id')
            ->whereNotIn('users.id', $friendUserIDs)
            ->where('users.id', '!=', $currentUserID)
            ->get(['users.*']);

        // dd($dataUser);

        return view('home', compact('dataUser'));
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
    public function destroy(string $id)
    {
        //
    }
}
