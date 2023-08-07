<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Topic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ClassroomController extends Controller
{
    //
    public function create()
    {
       return view('classrooms.create');
    }
    public function add(ClassroomRequest $request)
    {

        // $validated = $request->validate([
        //     'name' => 'required | max: 25',
        //     'section' => 'required | max: 225',
        //     'subject' => 'nullable',    
        // ],[
        //     'required' => ":attribute can't be empty"
        // ]);

        $validated = $request->validated();
        $data = $request->all();
        $validated['code'] = Str::random(5);
        $validated['user_id'] =Auth::id();
        $classroom =  new Classroom( $validated);
        DB::beginTransaction();
        try{
        $classroom->save();
        $classroom->join($classroom->id,'Teacher');

        DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return back()->withInput()->with('error',$e->getMessage());
        }
       return redirect(route('classrooms.show'));
    }
    public function show(Request $request )
    {
        $classrooms = Classroom::active()->get();
        $topics = Topic::all();
        $success = session('success');
        // redirect(route('classrooms.show',compact('classroom')));
        return view('classrooms.show', compact('classrooms', 'topics','success'));
    }
    public function view(Request $request ,$id)
    {
        $classroom = Classroom::find($id);
        $invitation_link =  URL::temporarySignedRoute('classrooms.join', now()->addHours(3) ,[
            'classroom' => $classroom->id,
            'code' => $classroom->code,
        ]);
        // redirect(route('classrooms.show',compact('classroom')));
        return view('classrooms.view', compact('classroom','invitation_link'));
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

    public function trashed(){
        $classrooms = Classroom::onlyTrashed()->latest()->get();

        return view('classrooms.trashed',compact('classrooms'));
    }
    public function restore($id){
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();

        return redirect( route('classrooms.show') )
        ->with('success', " \" {$classroom->name} \" Classroom Restored Successfully");

    }
    public function forceDelete($id){
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->forceDelete();
        // Classroom::deleteCoverImage($classroom->cover_image);
        return redirect( route('classrooms.show') )->with('success',"\" {$classroom->name} \" Classroom Deleted Successfully");
    }
}

