@extends('layout.base')

@section('body-container')
<div class="flex justify-center">
    <div class="mt-10 w-7/12 p-5 flex rounded-lg justify-between">
        <label for="email" class="sr-only"></label>
        <input type="text" name="name" id="taskinput" placeholder="Add your tasks here...." class="bg-white-100 border-2 w-9/12 p-4 rouded-lg">    
        <button class="bg-blue-300 w-2/12 p-4 rounded-xl" onclick="addTask()">Add Task</button>
    </div>
</div>


<div class="flex justify-center">
    <div class="mt-5 w-7/12 pr-5 pl-5 rounded-lg justify-between" id="pendingtask">
        <div class="font-medium border-2 w-full mb-2 mt-2 rouded-lg"> Pending Tasks... </div>
        @if ($pendingTasks)
            @foreach ($pendingTasks as $task)
                <div id="{{$task->id}}" class="bg-gray-100 border-2 w-full flex justify-between p-3 rouded-lg"> 
                    <i class="mt-1 text-gray-300 far fa-square cursor-pointer" onclick="moveTaskTo({{$task->id}}, 1)"></i>
                    <div class="w-10/12">
                        {{$task->name}}
                    </div>
                    <i class="mt-1 fas fa-trash-alt text-gray-300 cursor-pointer" onclick="deleteTask({{$task->id}})"></i>
                </div>
            @endforeach
    
        @endif
        
    </div>
</div>

<div class="flex justify-center">
    <div class="mt-5 w-7/12 pr-5 pl-5 rounded-lg justify-between" id="pendingtask">
        <div class="font-medium border-2 w-full mb-2 mt-2 rouded-lg"> Completed Tasks... </div>
        @if ($completedTasks)
            @foreach ($completedTasks as $task)
                <div id="{{$task->id}}" class="bg-red-200 border-2 w-full flex justify-between p-3 rouded-lg"> 
                    <i class="mt-1 far fa-check-square cursor-pointer" onclick="moveTaskTo({{$task->id}}, 0)"></i>
                    <div class="w-10/12 line-through">
                        {{$task->name}}
                    </div>
                    <i class="mt-1 fas fa-trash-alt cursor-pointer" onclick="deleteTask({{$task->id}})"></i>
                </div>
            @endforeach
        @endif 
    </div>
</div>
    
    
    <script>
        function moveTaskTo(id, state){
            $.ajax({
                type: "POST",
                url: `/api/tasks/${id}`,
                data: {status:state},
                dataType:'json',
                headers:{
                    'Authorization': 'Bearer {{auth()->user()->api_token}}'
                },
                success: (resp) =>  {
                    console.log(resp)
                }

            });

            
        }

        function deleteTask(id){
            $.ajax({
                type: "DELETE",
                url: `/api/tasks/${id}`,
                dataType:'json',
                headers:{
                    'Authorization': 'Bearer {{auth()->user()->api_token}}'
                },
                success: (resp) =>  {
                    console.log(resp)
                }

            });

            
        }

        function addTask(){
            const name = $('#taskinput').val()

            $.ajax({
                type: "POST",
                url: `/api/tasks`,
                data: {name},
                dataType:'json',
                headers:{
                    'Authorization': 'Bearer {{auth()->user()->api_token}}'
                },
                success: (resp) =>  {
                    console.log(resp)
                }

            });

            
        }

    </script>
@endsection


