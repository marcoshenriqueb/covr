<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMessageRequest;
use App\Own\Repositories\MessageRepo;
use App\Own\Repositories\ChatRepo;
use App\Events\BroadcastChatMessage;

class MessageApiController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id, ChatRepo $chatRepo)
    {
        return json_encode($chatRepo->getMessagesFromChat($id));
    }

    public function page($id, $index, ChatRepo $chatRepo)
    {
        return json_encode($chatRepo->getMessagesFromChat($id, ($index - 1) * 15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateMessageRequest $request, MessageRepo $repo)
    {
        $result = $repo->storeMessage($request);
        event(new BroadcastChatMessage($result, $request->input('userTo')));
        return json_encode($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, MessageRepo $repo)
    {
        return json_encode($repo->updateRead($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
