<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->where('id');

        $data = array(
            'users' => $users,

        );

        return view('admin', $data);
    }

    public function show($id)
    {
        $user = User::find ($id);

        $data = array(
            'id' => $id,
            'user' => $user
        );

        return view('admin', $data);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('users.index');
    }


}



