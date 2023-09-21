<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Symfony\Component\HttpFoundation\Response;

class MakeNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->query('nid');
        $user  = $request->user();
// dd($id);
        if($id && $user){
            // $notification = DatabaseNotification::find($id);
            $notification = $user->unreadNotifications()->find($id);
            if($notification){
                $notification->markAsread();
            }
        }
        return $next($request);
    }
}
