<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IntegrationController extends Controller
{
    public function chat(Request $request)
    {
         $validatedData = $request->validate([
            'message' => 'required|string',
        ]);
    
        $message = $validatedData['message'];
    
        $apiUrl = 'https://pro-fully-hermit.ngrok-free.app/chat';
    
         $response = Http::post($apiUrl, [
            'message' => $message,
        ]);
    
         if ($response->successful()) {
             $responseData = $response->json();
    
             $answer = isset($responseData['answer']) ? $responseData['answer'] : json_encode($responseData);
    
             $createHistory = Chat::create([
                'message' => $message,
                'answer' => $answer,  
            ]);
    
             return response()->json([
                'status' => 'success',
                'data' => $responseData,
            ]);
        } else {
             return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message',
            ], $response->status());
        }
    }
    
    

    public function fav(Request $request, $id)
    {
         $chat = Chat::find($id);
    
         if ($chat) {
             $chat->fav = 1;
            $chat->save();
    
             return response()->json(['message' => 'Chat marked as favorite successfully.'], 200);
        } else {
             return response()->json(['message' => 'Chat not found.'], 404);
        }
    }
    
    public function getChatWithUsers($id)
    {
         $chat = Chat::with('users')->find($id);

         if ($chat) {
            return response()->json([
                'status' => 'success',
                'data' => $chat
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Chat not found'
            ], 404);
        }
    }

}
