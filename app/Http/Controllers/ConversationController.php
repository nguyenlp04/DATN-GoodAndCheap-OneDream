<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function loadConversations(){


        $user_id = auth()->user()->user_id;



        $conversations = DB::table('conversations')
            ->where('user1_id', $user_id)
            ->orWhere('user2_id', $user_id)
            ->get();

        $userIds = $conversations->map(function($conversation) use ($user_id) {
            return $conversation->user1_id == $user_id ? $conversation->user2_id : $conversation->user1_id;
        })->unique();

        $users = DB::table('users')->whereIn('user_id', $userIds)->get();

        $data = $conversations->map(function($conversation) use ($users, $user_id) {
            return [
                'conversation' => $conversation,
                'user' => $users->firstWhere('user_id', $conversation->user1_id == $user_id ? $conversation->user2_id : $conversation->user1_id)
            ];
        });

        return view('message.message',['data'=>$data]);
    }

    public function CheckConversation(Request $request){
        $recipientId = $request->recipientId;
        $loggedInUserId = auth()->user()->user_id;


        $Conversation = Conversation::where(function ($query) use ($recipientId, $loggedInUserId) {
            $query->where('user1_id', $loggedInUserId)
                ->where('user2_id', $recipientId);
        })->orWhere(function ($query) use ($recipientId, $loggedInUserId) {
            $query->where('user1_id', $recipientId)
                ->where('user2_id', $loggedInUserId);
        })->first();

        if ($Conversation) {
            return response()->json([
                'channelExists' => true,
                'channelName' => $Conversation->conversation_name,
            ]);
        } else {
            return response()->json([
                'channelExists' => false,
            ]);
        }
}



    public function CreateConversation(Request $request){
        $recipientId = $request->recipientId;
        $loggedInUserId = auth()->user()->user_id;
        try {
            // Generate the channel name
            $channelName = 'chat-' . min($recipientId, $loggedInUserId) . '-' . max($recipientId, $loggedInUserId);


            // Create the channel in the database
            $channel = Conversation::create([
                'user1_id' => $loggedInUserId,
                'user2_id' => $recipientId,
                'conversation_name' => $channelName,
            ]);


            return response()->json([
                'success' => true,
                'channelName' => $channelName,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
