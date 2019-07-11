<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Repository;
use App\Repository\ConversationRepository;
use Illuminate\Auth\AuthManager;

class ConversationsController extends Controller
{
    /**
     * @var ConversationRepository
     */
    private $r;

    /**
     * @var AuthManger
     */
    private $auth;

    public function __construct(ConversationRepository $conversationRepository, AuthManager $auth)
    {
        $this->r = $conversationRepository;
        $this->auth = $auth;

    }


    public function index()
    {
       return view('conversations/index', [
            'users' => $this->r->getConversations($this->auth->user()->id)
       ]);
    }

    public function show(User $user)
    {
        //dd($user);
       return view('conversations/show', [
            'users' => $this->r->getConversations($this->auth->user()->id),
            'user' => $user,
         //   'messages' => $this->r->getMessagesFor($this->auth->user()->id, $user->id)->get()
       ]);
    }


    public function store (User $user, Request $request)
    {
        $this->r->createMessage(
            $request->get('content'),
            $this->auth->user()->id,
            $user->id,
        );
        return redirect(route('conversations.show',['id' => $user->id]));
    }

}
