<?php

namespace App\Http\Controllers\todo;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function index(Request $request){
        $tasks = User::find($request->user()->id)->task;
        $pendingTasks = array();
        $completedTasks = array();

        foreach ($tasks as $key => $task) {
            if($task->status)
                array_push($completedTasks, $task);
            else
                array_push($pendingTasks, $task);

        }
        return view('todo')->with('pendingTasks', $pendingTasks)->with('completedTasks',$completedTasks);
    }
}
