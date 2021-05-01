<?php

namespace App\Http\Controllers\task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //
    public function getAllTasks(Request $request) {
        return Task::all()->where('user_id', $request->user()->id);
    }

    public function CreateNewTask(Request $request) {
    
        $request->validate([
            'name'=>'required|min:3|max:500'
        ]);
    
        $task = Task::create([
            'name' => $request->name,
            'status' => $request->status || 0,
            'user_id' => $request->user()->id
        ]);
        
        return $task ? json_encode(['status'=>1, 'taskObject'=> $task, 'message'=>'task created successfully']) :
        json_encode(['status'=>0, 'message'=>'Internal server error']);
    
    }

    public function updateTasksById(Request $request, $id) {
        $task = Task::find($id);
         
        if(! $task ){
            return json_encode(
                [
                    'status' => 0, 
                    'message' =>'No tasks with the given id',
                ]
            );
        }
        
        $request->validate([
            'status'=>'required|integer|min:0|max:1'
        ]);
        
        if( $task->update([
            'status'=>$request->status
        ])){
            return ($request->status==1) ? json_encode(['status'=>1, 'taskObject'=> $task, 'message'=>'Marked task as done'])
            : json_encode(['status'=>1, 'taskObject'=> $task, 'message'=>'Marked task as pending']);  
        } else {
            return json_encode(['status'=>0, 'message'=>'Internal Server Error']);  
        }
    }

    public function deleteTaskById(Request $request, $id) {

        if(! Task::find($id)){
            return json_encode(
                [
                    'status' => 0, 
                    'message' =>'No tasks with the given id',
                ]
            );
        }
    
        return (Task::find($id)->delete()) ? 
             json_encode(['status'=>1, 'message'=>'Task deleted successfully']) :
                json_encode(['status'=>0, 'message'=>'Internal Server Error']);  
    }
}
