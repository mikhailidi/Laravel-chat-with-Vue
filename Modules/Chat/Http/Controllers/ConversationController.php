<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Chat\Events\PrivateMessage;
use Modules\Chat\Models\Conversation;
use Illuminate\Http\Request;
use Modules\Chat\Models\Message;
use Nwidart\Modules\Routing\Controller;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Conversation::where('user_from', Auth::id())
            ->orWhere('user_to', Auth::id())
            ->orWhere('type', 'public')
            ->with(['fromUser', 'toUser'])
            ->groupBy('id')
            ->latest('updated_at')
            ->get());
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
     * @return string
     */
    public function store(Request $request)
    {
        // TODO: different conversation types
        $friend = json_decode($request->get('friend'), true);

        $conversation = Conversation::getUsersConversation(Auth::id(), $friend['user']['id']);

        if (! $conversation) {
            $conversation = new Conversation;
            $conversation->type = 'private';
            $conversation->user_from = Auth::id();
            $conversation->user_to = $friend['user']['id'];

            $conversation->save();
        }

        $message = new Message();
        $message->setMessage($request->get('message'));
        $message->setUserId(Auth::id());
        $message->setConversationId($conversation->id);

        if ($message->save()) {
            $message->load('user');
            broadcast(new PrivateMessage($message));

            return $message->toJson();
        }


        return response()->json(['Problem while saving new conversation'])->setStatusCode(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  Conversation $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Conversation $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Conversation $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Conversation $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
