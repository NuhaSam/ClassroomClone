<?php

namespace App\Http\Controllers;

use App\Models\Classwork;
use App\Models\ClassworkUser;
use App\Models\Submision;
use App\Models\Submission;
use App\Rules\ForbiddenFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function store(Request $request, Classwork $classwork)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => ['file', new ForbiddenFile('application/x-msdownload')],
        ]);

        $assigned = $classwork->users()->where('user_id', Auth::id())->exists();
        if (!$assigned) {
            abort('403');
        }
        // dd($classwork->id);
        DB::beginTransaction();
        try {
            $data = [];
            foreach ($request->file('files') as $file) {
                $data[] = [
                    'user_id' => Auth::id(),
                    'classwork_id' => $classwork->id,
                    'content' => $file->store("submissions/{$classwork->id}"),
                    'type' => 'file',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            // dd($data);
            Submission::insert($data);
            ClassworkUser::where([
                'user_id' => Auth::id(),
                'classwork_id' => $classwork->id,
            ])->update([
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success', 'sublitted successfully');
    }

    public function file(Submission $submission){
        $isOwner =  $submission->user_id == Auth::id();
        $isTeacher = $submission->classwork->classroom->teachers()->where('id',Auth::id())->exists();

        if(!$isOwner && !$isTeacher){
            abort('403');
        }
        // dd($submission->content);
        return response()->file(storage_path('app/'.$submission->content));
    }
}
