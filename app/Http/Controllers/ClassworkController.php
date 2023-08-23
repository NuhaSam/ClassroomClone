<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassworkRequest;
use App\Models\Classwork;
use App\Models\Classroom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ClassworkController extends Controller
{

    public function getType(){
        $type= request()->query('type');
        $allowed_types = [
            "assignment",
            'material',
            'question',
        ];
        if(! in_array($type, $allowed_types)){
            $type = 'assignment';
        }
        return $type;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Classroom $classroom)
    {
        $classworks = $classroom->classworks()->with('topics')->latest()->filter($request->query())->paginate(5);
        // $classworks->groupBy('topic_id');
        return view('classworks.index',compact('classworks','classroom'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Classroom $classroom)
    {
        Gate::allows('classworks.create',[$classroom]);
        $type = $this->getType();
        $error = session('error');
        return view('classworks.create', compact('classroom','type','error'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Classroom $classroom)
    {   
        
        Gate::allows('classworks.create',[$classroom]);
        $type = $this->getType();
        // return $type;
        try{
        DB::transaction( function () use ($request ,$classroom,$type){

            // $data = [
            //     'user_id' =>Auth::id(),
            //     'type' => $type,
            //     'title' => $request->input('title'),
            //     'description' => $request->input('description'),
            //     'topic_id' => $request->input('topic_id'),
            //     'options' => [
            //             'grade' => $request->input('grade'),
            //             'due' => $request->input('due'),
            //     ],

            // ];
       
        $classwork = $classroom->classworks()->create($request->all());
        $classwork->users()->attach($request->input('students'));
    });
    }catch(Exception $e){
        return back()->with('error', $e->getMessage());
    }
       return redirect( route('classroom.classworks.index', $classroom->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom,Classwork $classwork)
    {
          // Eager Load.
           //  $classwork->load('comments.user');
           $submissions =  Auth::user()->submissions()->where('classwork_id',$classwork->id)->get();
           $success = session('success');
        return view('classworks.show', compact('classwork', 'classroom','success','submissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom ,Classwork $classwork )
    {
        // $classwork = Classwork::find($classwork->id);
        $type = $classwork->type;
        $assigned = $classwork->users()->pluck('id')->toArray();
        return view('classworks.edit',compact('classwork','classroom','type','assigned'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassworkRequest $request,Classroom $classroom, Classwork $classwork)
    {
        $validated = $request->validated();
        $classwork->update($validated);
        $classwork->users()->sync($request->input('students'));

        return redirect(route('classroom.classworks.index', $classroom->id));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classwork $classwork,Classroom $classroom)
    {
        
        Classwork::destroy($classwork->id);
        return redirect(route('classroom.classwork.index'));
    }
}
