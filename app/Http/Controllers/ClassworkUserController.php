<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassworkUserController extends Controller
{
    public function __invoke(User $user, Classroom $classroom)
    {
        $peoples = $classroom->users()->orderBy('name', 'DESC')->get()->groupBy('pivot.role');
        $peopleCount = $classroom->users()->wherePivot('role','Student')->count();

        // $user = Auth::user();
        $owner = $user->classrooms()->withoutGlobalScopes()->where('classroom_user.user_id',Auth::id())->exists();
        // dd($owner);
        return view('classrooms.people', [
            'people' => $peoples,
            'classroom' => $classroom,
            'count' => $peopleCount,
            'owner' => $owner,
        ]);
    }
    public function destroy(Request $request, Classroom $classroom)
    {
        $request->validate([
            'user_id' => ['required',],
        ]);
        $user_id = $request->input('user_id');
        if ($user_id == $classroom->user_id) {
            return redirect()
                ->route('classrooms.people', $classroom->id)
                ->with('danger', 'User Cannot Removed!');
        }
        $classroom->users()->detach($user_id);

        return redirect()
            ->route('classrooms.people', $classroom->id)
            ->with('success', 'User Removed!');
    }
}
