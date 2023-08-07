<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{

    public function index()
    {
        $topics = Topic::get();
        $success = session('success');
        return view('topics.index', compact('topics','success'));
    }

    // public function view()
    // {
    //    Method to Show Topic Details
    //     return view('topic.view');
    // }


    public function create()
    {
        return view('topics.create');
    }

    public function add(Request $request)
    {
        $topic = new Topic();
        $topic->name = $request->post('name');
        $topic->classroom_id = $request->post('classroom_id');
        $topic->user_id = $request->post('user_id');
$topic->updated_at = date('y-m-d H:i:s');
$topic->created_at = date('y-m-d H:i:s');
        $topic->save();

        return redirect(route('topic.index'));
    }
    public function edit($id)
    {
        $topic = Topic::find($id);
        return view('topics.edit', compact('topic'));
    }
    public function update(Request $request, $id)
    {
        $topic = Topic::find($id);
        $topic->name = $request->post('name');
        $topic->classroom_id = $request->post('classroom_id');
        $topic->user_id = $request->post('user_id');

        $topic->save();

        return redirect(route('topic.index'));
    }

    public function delete($id)
    {
        Topic::destroy($id);
        return redirect(route('topic.index'));
    }

    public function trashed(){
        $topics = Topic::onlyTrashed()->latest()->get();

        return view('topics.trashedTopics', compact('topics'));
    }

    public function restoreTopic($id){
        $topic = Topic::onlyTrashed()->findOrFail($id);
        $topic->restore();

        return redirect(route('topic.index'))
                ->with('success', "\" ".$topic->name ." \" Topic Restored Successfully");

    }
    public function forceDeleteTOpic($id){
        $topic = Topic::onlyTrashed()->findOrFail($id);
        $topic->forceDelete();

        return redirect()->route('topic.index')->with('success', "\" ".$topic->name ." \" Topic Deleted Successfully");
    }
}
