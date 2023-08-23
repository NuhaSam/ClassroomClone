<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'content' => 'required | string',
            'id'    => 'required | integer',
            'type' => ['required' ,'in:Classwork,Post']
        ]);
        Auth::user()->comments()->create([
            'commentable_id' => $request->input('id'),
            'commentable_type' =>$request->input('type'),
            'content' => $request->input('content'),
            'ip' =>$request->ip(),
            'user_agent' =>$request->header('user-agent'),
     
        ]);

        return back()->with('success','Comment Added');
    }
}
