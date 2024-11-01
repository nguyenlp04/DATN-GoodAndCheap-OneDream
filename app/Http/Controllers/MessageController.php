<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function store(Request $request)
    {

        // $loggedInUserId = auth()->user()->user_id;
        $validatedData = $request->validate([
            'conversation_name'=>'required|string',
            'message_person' => 'required|integer',
            'data' => 'required|string',
        ]);

        // Tìm cuộc trò chuyện dựa trên tên
        $conversation = Conversation::where('conversation_name',$validatedData['conversation_name'] )->first();

        if (!$conversation) {
            return response()->json(['success' => false, 'message' => 'Conversation not found.'], 404);
        }

        // Tạo tin nhắn mới
        $message = Message::create([
            'conversation_name' => $validatedData['conversation_name'],
            'message_person' => $validatedData['message_person'],
            'data' => $validatedData['data'],


        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function getMessages(Request $request, $name)
{
    $user_id = auth()->user()->user_id;



        $messages = Message::where('conversation_name', $name)->get();
        //     $conversations = DB::table('conversations')
        //     ->where('conversation_name', $name)
        //     ->get();

        // $userIds = $conversations->map(function($conversation) use ($user_id) {
        //     return $conversation->user1_id == $user_id ? $conversation->user2_id : $conversation->user1_id;
        // })->unique();

        // $users = DB::table('users')->whereIn('user_id', $userIds)->first();


        if($messages){
        return response()->json([
         'getmessExists' => true,
         'messages' => $messages,
        //  'receiver'=>$users->full_name
        ]);
        }else{
            return response()->json([
                'getmessExists' => false,
            ]);

        }


}


}
