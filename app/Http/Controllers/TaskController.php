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
            'users_id' => 'required|numeric',
            'projects_id' => 'required|numeric'
        ]);
        $name = $request->get('name');
        $description = $request->get('description');
        $users_id = $request->get('users_id');
        $projects_id = $request->get('projects_id');

        $task = new Task([
           'name' => $name,
           'description' => $description,
           'users_id' => $users_id,
           'projects_id' => $projects_id
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
        //
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
        //
    }
}
