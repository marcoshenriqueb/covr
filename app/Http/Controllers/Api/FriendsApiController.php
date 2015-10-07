<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Own\Repositories\FriendsRepo;

class FriendsApiController extends Controller
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
    public function index(FriendsRepo $repo)
    {
      $people = [
        'friends' => $repo->getFriends()->toArray(),
        'requests' => $repo->getRequests()->toArray(),
        'requested' => $repo->getRequested()->toArray()
      ];
      return json_encode($people);
    }

    public function request(Request $request, FriendsRepo $repo)
    {
      return json_encode($repo->requestFriend($request));
    }

    public function confirm(Request $request, FriendsRepo $repo)
    {
      return json_encode($repo->confirmFriend($request));
    }

    public function removeRequest(Request $request, FriendsRepo $repo)
    {
      return json_encode($repo->removeRequest($request));
    }

    public function cancelRequest(Request $request, FriendsRepo $repo)
    {
      return json_encode($repo->cancelRequest($request));
    }

    public function search($q, FriendsRepo $repo)
    {
      return json_encode($repo->search($q));
    }

    public function destroy(Request $request, FriendsRepo $repo)
    {
      return json_encode($repo->removeFriend($request));
    }
}
