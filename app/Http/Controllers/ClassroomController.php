<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class ClassroomController extends Controller
{
    //
    public function create()
    {
       return view('classrooms.create');
    }
     public static int $i=1;

    public function add(Request $request)
    {
        $data = $request->all();
        $data['code'] = Str::random(5);
        $data['user_id'] = self::$i;
        self::$i = 2 + self::$i;
        $classroom =  new Classroom( $data);
        $classroom->save();

       return redirect(route('classrooms.show'));
    }
    public function show(Request $request )
    {
        $classrooms = Classroom::all();
        $topics = Topic::all();
        // redirect(route('classrooms.show',compact('classroom')));
        return view('classrooms.show', compact('classrooms', 'topics'));
    }
    public function view(Request $request ,$id)
    {
        $classroom = Classroom::find($id);
        
        // redirect(route('classrooms.show',compact('classroom')));
        return view('classrooms.view', compact('classroom'));
    }

    public function edit(Request $request ,$id)
    {
        $classroom = Classroom::find($id);
        return view('classrooms.edit', compact('classroom'));
    }
    public function update(Request $request ,$id)
    {
        $classroom = Classroom::find($id);
        $classroom->update($request->all());
        return Redirect::route('classrooms.show');
    }
    public function delete($id)
    {
        Classroom::destroy($id);
        // $classroom = Classroom::find($id);
        return Redirect::route('classrooms.show');
    }

}
