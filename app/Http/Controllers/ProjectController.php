<?php

namespace App\Http\Controllers;
use Flugg\Responder\Responder;
use JWTAuth;
use App\Project;
use Illuminate\Http\Request;
use Namshi\JOSE\JWT;


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
              'href' => 'api/v1/project/'.$project->id,
              'method' => 'GET'
            ];
        }
        $response = [
            'msg' => 'List of projects',
            'project' => $projects
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
           'name' => 'required|min:10'
        ]);
        $token = JWTAuth::getToken();
        $user_role = JWTAuth::toUser($token)->level;
        if($user_role != 1){
            return responder()->error(404, 'This user is not permission to create project');
        }
//        if(!$user = JWTAuth::parseToken()->authenticate()) {
//            return  responder()->error(404, 'User not found');
//        }
        $name_project = $request->get('name');

        $project = new Project([
           'name' => $name_project
        ]);
        if($project->save()){
            $project->view_project = [
              'href' => 'api/v1/project/'.$project->id,
              'method' => 'GET'
            ];
            $response = [
              'msg' => 'Created successfully',
              'project' => $project
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
        $project = Project::find($id);
        $project->view_projects = [
          'href' => 'api/v1/project',
          'method' => 'GET'
        ];
        $response = [
          'msg' => 'Project info',
          'project' => $project
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
        //
    }
}
