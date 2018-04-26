<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        foreach($users as $user){
            $user->view_user = [
              'href' => 'api/v1/user/'.$user->id,
              'method' => 'GET'
            ];
            $user->role = $user->role->name;
        }
        $response = [
          'msg' => 'List of users',
          'user' => $users
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);
        $name = $request->get('name');
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
        if($user->save()){
            $user->login = [
                'href' => 'api/v1/login',
                'method' => 'POST',
                'params' => 'email, password'
            ];
            $response = [
                'msg' => 'User is created successfully',
                'user' => $user
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
    public function login(Request $request){
        $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return responder()->error(401,'invalid_credentials');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return responder()->error(500, 'could_not_create_token');
        }

        // all good so return the token
        return responder()->success(compact('token'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->view_users = [
          'href' => 'api/v1/user',
          'method' => 'GET'
        ];
        $response = [
          'msg' => 'User information',
          'user' => $user
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
