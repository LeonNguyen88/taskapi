<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        foreach($tasks as $task){
            $task->view_task = [
              'href' => 'api/v1/task/'.$task->id,
              'method' => 'GET'
            ];
        }
        $response = [
          'msg' => 'List of task',
          'task' => $tasks
        ];
        return responder()->success($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required|min:10',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'end_date' => 'date',
            'users_id' => 'required|numeric',
            'projects_id' => 'required|numeric'
        ]);
        $name = $request->get('name');
        $description = $request->get('description');
        $users_id = $request->get('users_id');
        $projects_id = $request->get('projects_id');
        $start_date = $request->get('start_date');
        $due_date = $request->get('due_date');
        $end_date = $request->get('end_date');

        $task = new Task([
           'name' => $name,
           'description' => $description,
           'users_id' => $users_id,
           'projects_id' => $projects_id,
           'start_date' => $start_date,
           'due_date' => $due_date,
           'end_date' => $end_date
        ]);
        if($task->save()){
            $task->view_task = [
              'href' => 'api/v1/task/'.$task->id,
              'method' => 'GET'
            ];
            $response = [
                'msg' => 'Task is created successfully',
                'task' => $task
            ];
            return responder()->success($response);
        }
        else{
            $response = [
              'msg' => 'Error occurred !'
            ];
            return responder()->error($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $task->view_tasks = [
          'href' => 'api/v1/task',
          'method' => 'GET'
        ];
        $response = [
          'msg' => 'Task infomation',
          'task' => $task
        ];
        return responder()->success($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        $response = [
            'msg' => 'Task is removed',
            'task' => $task,
            'create task' => [
                'href' => 'api/v1/task/create',
                'method' => 'POST',
                'params' => 'name, description, users_id, projects_id'
            ]
        ];
        return responder()->success($response);
    }
}
