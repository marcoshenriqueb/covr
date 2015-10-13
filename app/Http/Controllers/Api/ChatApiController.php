<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateChatRequest;
use App\Own\Repositories\ChatRepo;
use App\Own\Repositories\BidsRepo;
use App\Events\ChatHasBeenDeleted;
use App\Events\ChatHasBeenCreated;

class ChatApiController extends Controller
{

    public function __construct()
    {
      $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ChatRepo $chatRepo)
    {
        return json_encode($chatRepo->getChats());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateChatRequest $request, ChatRepo $repo, BidsRepo $bidsRepo)
    {
        $user = $bidsRepo->getUserFromBidRequest($request);
        $result = $repo->checkIfChatExists($user);
        if(!$result){
          $stored = $repo->storeChat($user);
          if ($stored) {
            event(new ChatHasBeenCreated($stored));
          }
          return json_encode($stored);
        }else {
          return $result;
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, ChatRepo $repo)
    {
        $_id = $repo->getChatOtherUserId($id);
        if ($result = $repo->destroy($id)) {
          event(new ChatHasBeenDeleted($_id, $id));
        }
        return json_encode($result);
    }
}
