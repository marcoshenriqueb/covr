<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AppController extends Controller
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
    public function index()
    {
        return view('app', ['user' => Auth::user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */



}
