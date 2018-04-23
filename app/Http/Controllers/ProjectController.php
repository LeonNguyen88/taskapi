<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        $projects = Project::all();
        foreach($projects as $project){
            $project->view_project = [
              'href' => 'app/v1/project/'.$project->id,
              'method' => 'GET'
            ];
        }
        $response = [
            'msg' => 'List of projects',
            'project' => $projects
        ];
        return response()->json($response, 200);
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
           'name' => 'required|min:10'
        ]);
        $name_project = $request->get('name');
        $project = new Project([
           'name' => $name_project
        ]);
        if($project->save()){
            $project->view_project = [
              'href' => 'app/v1/project'.$project->id,
              'method' => 'GET'
            ];
            $response = [
              'msg' => 'Created successfully',
              'project' => $project
            ];
            return response()->json($project, 201);
        }
        else{
            $response = [
              'msg' => 'Error occurred !'
            ];
            return response()->json($response, 404);
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
