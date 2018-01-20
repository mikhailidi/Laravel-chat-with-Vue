<?php

namespace App\Http\Controllers;

use App\Friend;
use App\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Friend::where('user_id', Auth::user()->getId())
            ->with('user')
            ->paginate(14);

        return view('friends.index', [
            'friends' => $friends
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Exception If user_id == friend_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'friend_id' => 'required|min:1|numeric'
        ]);

        $friendId = (int)$request->input('friend_id');

        if ($friendId == Auth::user()->getId()) {
            throw new \Exception('You can not add yourself to your friends list');
        }

        $friendRequest = new FriendRequest([
            'from_user' => Auth::user()->getId(),
            'to_user' => $friendId
        ]);

        if ($friendRequest->save()) {
            return redirect()->back();
        } else {
            dd('ERROR WHILE SAVING DATA');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }
}
