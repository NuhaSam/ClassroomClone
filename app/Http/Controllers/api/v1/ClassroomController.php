<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Classroom::with('topics:id,name')->get();
    //    return Response::json([
    //     'classroom' => Classroom::all(),
    //     'classrooms' => 'dd',
    //    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $classroom = Classroom::create($request->all());
        return $classroom;
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        return new ClassroomResource($classroom->load('user')->loadCount('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => ['sometimes','required', Rule::unique('classrooms','name')->ignore($classroom->id)],
            'subject' => 'sometimes |required',
        ]);
        $classroom->update($request->all());

        return [
            'code' => 100,
            'message' => "Updated successfully",
            'classroom' => $classroom,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
