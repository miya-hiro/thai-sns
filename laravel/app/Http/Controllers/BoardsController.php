<?php

namespace App\Http\Controllers;
use App\Board;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BoardsController extends Controller
{
    public function index()
    {
        $current_user_id = Auth::user()->id;
        $boards = Board::where('s_user_id', $current_user_id)->orwhere('r_user_id', $current_user_id)->get();

        return view('users.mypage', ['boards' => $boards]);
    }

    public function show($id)
    {
        $messages = Message::where('board_id', $id)->get();
        $board = Board::find($id);

        return view('message', ['messages' => $messages, 'board' => $board]);
    }

    public function store(Request $request)
    {
        $board = new Board;
        $board->s_user_id = $request->s_user_id;
        $board->r_user_id = $request->r_user_id;
        $board->save();

        return redirect()->action(
            'BoardsController@index',
            ['board' => $board]
        );
    }
}
