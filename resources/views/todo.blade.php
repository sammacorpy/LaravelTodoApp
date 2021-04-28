@extends('layout.base')

@section('body-container')
<div class="flex justify-center">
    <div class="mt-10 w-7/12 p-5 flex rounded-lg justify-between">
        <label for="name" class="sr-only"></label>
        <input type="text" name="name" id="taskinput" placeholder="Add your tasks here...." class="bg-white-100 border-2 w-9/12 p-4 rouded-xl">    
        <button class="bg-blue-300 w-2/12 p-4 rounded-xl" onclick="addTask()">Add Task</button>
    </div>
</div>


<div class="flex justify-center">
    <div class="mt-5 w-7/12 pr-5 pl-5 rounded-lg justify-between" id="pendingtasks">
        <div class="font-medium border-2 w-full mb-2 mt-2 rouded-lg"> Pending Tasks... </div>
        @if ($pendingTasks)
            @foreach ($pendingTasks as $task)
                <div id="p{{$task->id}}" class="bg-gray-100 border-2 w-full flex justify-between p-3 rouded-lg"> 
                    <i class="mt-1 text-gray-300 far fa-square cursor-pointer" onclick="moveTaskTo({{$task->id}}, 1)"></i>
                    <div class="w-10/12">
                        {{$task->name}}
                    </div>
                    <i class="mt-1 fas fa-trash-alt text-gray-300 cursor-pointer" onclick="deleteTask('p', {{$task->id}})"></i>
                </div>
            @endforeach
    
        @endif
        
    </div>
</div>

<div class="flex justify-center">
    <div class="mt-5 w-7/12 pr-5 pl-5 rounded-lg justify-between" id="completedtasks">
        <div class="font-medium border-2 w-full mb-2 mt-2 rouded-lg"> Completed Tasks... </div>
        @if ($completedTasks)
            @foreach ($completedTasks as $task)
                <div id="c{{$task->id}}" class="bg-red-200 border-2 w-full flex justify-between p-3 rouded-lg"> 
                    <i class="mt-1 far fa-check-square cursor-pointer" onclick="moveTaskTo({{$task->id}}, 0)"></i>
                    <div class="w-10/12 line-through">
                        {{$task->name}}
                    </div>
                    <i class="mt-1 fas fa-trash-alt cursor-pointer" onclick="deleteTask('c', {{$task->id}})"></i>
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
                    if(resp.status && state==1){
                        $(`#p${resp.taskObject.id}`).remove()
                        $('#completedtasks').append(`
                        <div id="c${resp.taskObject.id}" class="bg-red-200 border-2 w-full flex justify-between p-3 rouded-lg"> 
                            <i class="mt-1 far fa-check-square cursor-pointer" onclick="moveTaskTo(${resp.taskObject.id}, 0)"></i>
                            <div class="w-10/12 line-through">
                                ${resp.taskObject.name}
                            </div>
                            <i class="mt-1 fas fa-trash-alt cursor-pointer" onclick="deleteTask('c', ${resp.taskObject.id})"></i>
                        </div>
                        `)
                    } else if (resp.status && state==0){
                        $(`#c${resp.taskObject.id}`).remove()
                        $('#pendingtasks').append(`
                        <div id="p${resp.taskObject.id}" class="bg-gray-100 border-2 w-full flex justify-between p-3 rouded-lg"> 
                            <i class="mt-1 text-gray-300 far fa-square cursor-pointer" onclick="moveTaskTo(${resp.taskObject.id}, 0)"></i>
                            <div class="w-10/12">
                                ${resp.taskObject.name}
                            </div>
                            <i class="mt-1 fas fa-trash-alt text-gray-300 cursor-pointer" onclick="deleteTask('p', ${resp.taskObject.id})"></i>
                        </div>
                        `)
                    }
                }

            });

            
        }

        function deleteTask(from, id){
            $.ajax({
                type: "DELETE",
                url: `/api/tasks/${id}`,
                dataType:'json',
                headers:{
                    'Authorization': 'Bearer {{auth()->user()->api_token}}'
                },
                success: (resp) =>  {
                    $(`#${from}${id}`).remove()
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
                    $('#pendingtasks').append(`
                        <div id="p${resp.taskObject.id}" class="bg-gray-100 border-2 w-full flex justify-between p-3 rouded-lg"> 
                            <i class="mt-1 text-gray-300 far fa-square cursor-pointer" onclick="moveTaskTo(${resp.taskObject.id}, 1)"></i>
                            <div class="w-10/12">
                                ${resp.taskObject.name}
                            </div>
                            <i class="mt-1 fas fa-trash-alt text-gray-300 cursor-pointer" onclick="deleteTask('p', ${resp.taskObject.id})"></i>
                        </div>
                    `)
                }

            });

            
        }

    </script>
@endsection


