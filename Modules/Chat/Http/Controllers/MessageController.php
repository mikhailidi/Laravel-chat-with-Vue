<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Chat\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return \response()->json(Message::with('user')->get());
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
     * @param  Request $request
     * @return string
     */
    public function store(Request $request)
    {
        //dd($request->get('message'));
        $message = new Message;
        $message->setMessage($request->get('message'));
        $message->setUserId(Auth::id());

        if ($message->save()) {
            $message->load('user');
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
