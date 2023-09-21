<?php

namespace App\Listeners;

use App\Models\Stream;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class PostInClassroomSrteam
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        // dd($event->classwork->user);
        $classwork = $event->classwork;
        $content = __(':name posted new :type : :title',[
            'name' => $classwork->user->name,
            'type' => __($classwork->type),
            'title' => $classwork->title,
        ]);
        Stream::create([
            'uuid' => Str::uuid(),
            'user_id' => $classwork->user->id,
            'classroom_id' => $classwork->classroom_id,
            'link' => route('classroom.classworks.show',[
                $classwork->classroom_id,$classwork->id,
            ]),
            'created_at' => now(),
            'content' =>$content,

        ]);
    }
}
