<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use Exception;
use Illuminate\Support\Facades\Auth;

class JoinClassroomController extends Controller
{
    //
    public function create($id)
    {
        $classroom = Classroom::active()->withoutGlobalScope('userClassroom')->findOrFail($id);

        // if($this->exists($classroom->id,Auth::id())){
        //     return redirect( route('classrooms.view', $classroom->id));
        // }
        try {
            $this->exists($classroom->id, Auth::id());
        } catch (Exception $e) {
            return redirect(route('classrooms.view', $classroom->id));
        }
        return view('classrooms.join', compact('classroom'));
    }

    public function store(Request $request, $id)
    {

        $request->validate([
            'role' => 'in:Student,Teacher',
        ]);

        $classroom = Classroom::active()->withoutGlobalScope('userClassroom')->findOrFail($id);

        try {
            $classroom->join(Auth::id(),$request->input('role'));
        
        } catch (Exception $e) {
            return redirect(route('classrooms.view', $classroom->id));
        }
        // DB::table('classroom_user')->insert([
        //     'classroom_id' => $classroom->id,
        //     'user_id' =>Auth::id(),
        //     'role' => $request->input('role','student'),
        //     'created_at' => now(),
        // ]);
       
        return redirect(route('classrooms.view', $classroom->id));
    }

    // public function exists($classroom_id,$user_id){
    //     return DB::table('classroom_user')
    //     ->where('classroom_id',$classroom_id)
    //     ->where('user_id',$user_id)->exists();
    // }
    public function exists(Classroom $classroom, $user_id)
    {
        // $exists =  DB::table('classroom_user')
        //     ->where('classroom_id', $classroom_id)
        //     ->where('user_id', $user_id)->exists();


        // nested of above code , we can do it using relations. 
        $exists = $classroom->users()->where('user_id',$user_id)->exists();


        /**
         *  Classroom::where('id', $classroom_id)
         *   ->whereHas('users', function ($query) use ($user_id) {
         *     $query->where('id', $user_id);
         *})
         *->exists();

         */

        if ($exists) {
            throw new Exception('The User already exists');
        }
    }
}
