<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Chat\Events\NewMessage;
use Modules\Chat\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $conversationId Conversation id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($conversationId = 1)
    {
        //\response()->json([$conversationId])->setStatusCode(500);
        return \response()->json(Message::with('user')->where('conversation_id', $conversationId)->get());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param int $conversationId
     *
     * @throws \Exception
     * @return string
     */
    public function store(Request $request)
    {
        $message = new Message;
        $message->setMessage($request->get('message'));
        $message->setUserId(Auth::id());
        $message->setConversationId($request->get('conversation_id'));

        if ($message->save()) {
            $message->load('user');
            broadcast(new NewMessage($message))->toOthers();

            return $message->toJson();
        }

        throw new \Exception('Bkabkabka');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('chat::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('chat::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
