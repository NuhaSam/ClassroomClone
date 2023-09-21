<?php

namespace App\Http\Controllers\api\v1;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Message;
use Illuminate\Http\Request;

class ClassroomMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {
        dd('index');
        return $classroom->messages()
                        ->select([
                            'messages.id',
                            'messages.sender_id',
                            'messages.recipient_id',
                            'messages.recipient_type',
                            'messages.body',
                            'messages.created_at as sent_at',
                            
                        ])->with('sender:id,name')->latest()->paginate(30);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Classroom $classroom)
    {
        dd('dddd');
        $request->validate([
            'body' => 'required | string',
        ]);
        // $message = $classroom->messages()->create([
        // ]);
        $message = Message::create([
            'sender_id' => $request->user()->id,
            'body' => $request->post('body'),
            'recipient_type' =>'Classroom',
            'recipient_id' =>$classroom->id,
        ]);
        event(new MessageSent($message));

        return $message;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message, string $id)
    {
        $request->validate([
            'body' => 'required',
        ]);
        $message->update([
            'body' => $request->post('body'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message, string $id)
    {
        $message->delete();
        return [];
    }
}
