<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ConversationsController extends Controller
{
    public  function index()
    {
       $users =  User::select('name', 'id')->where('id', '!=', Auth::user()->id)->get();
       return view('conversations/index', compact('users'));
    }

    public function show(int $id)
    {
        
    }
}
