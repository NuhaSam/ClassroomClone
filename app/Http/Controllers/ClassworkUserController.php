<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassworkUserController extends Controller
{
    public function __invoke(Classroom $classroom)
    {
        // $classroom->users()->get()->groupBy('role');
        return view('classrooms.people', [
            'people' => $classroom->users()->orderBy('name', 'DESC')->get()->groupBy('pivot.role'),
            'classroom' => $classroom
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
