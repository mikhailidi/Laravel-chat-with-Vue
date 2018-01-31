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
        $userId = Auth::user()->getId();
        $friends = Friend::where('user_id', $userId)
            ->with('user')
            ->paginate(14);

        $friendRequests = FriendRequest::where('to_user', $userId)
            ->paginate(14);

        $outgoingRequests = FriendRequest::where('from_user', $userId)
            ->paginate(14);

        return view('friends.index', [
            'friends' => $friends,
            'friendRequests' => $friendRequests,
            'outgoingRequests' => $outgoingRequests
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
     * @param int $id Friend id which we should add
     *
     * @throws \Exception If user_id == friend_id
     * @return \Illuminate\Http\Response|string
     */
    public function store(Request $request, $id)
    {
        $id = (int)$id;

        if ($id == Auth::user()->getId()) {
            throw new \Exception('You can not add yourself to your friends list');
        }

        $friendRequest = new FriendRequest([
            'from_user' => Auth::user()->getId(),
            'to_user' => $id
        ]);

        if ($friendRequest->save()) {
            if($request->ajax()){
                return "Successfully added";
            }
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

    public function acceptRequest(Request $request, $id)
    {
        $friendRequest = FriendRequest::find($id);

        if ($friendRequest) {
            $friend1 = new Friend([
                'user_id' => Auth::user()->getId(),
                'friend_id' => $friendRequest->getFromUser()->getId()
            ]);

            $friend2 = new Friend([
                'user_id' => $friendRequest->getFromUser()->getId(),
                'friend_id' => Auth::user()->getId()
            ]);

            if ($friend1->save() && $friend2->save()) {
                $friendRequest->delete();
                return response()->json(['status' => 'friend.added']);
            }
        }
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return string
     */
    public function deleteRequest(Request $request, $id)
    {
        $friendRequest = FriendRequest::find($id);

        if ($friendRequest) {
            if ($friendRequest->delete()) {
                return 'Friend request deleted';
            }
        } else {
            dd('NO FRIEND REQUEST FOUND');
        }

    }
}
