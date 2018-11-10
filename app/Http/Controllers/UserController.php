<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function index()
    {
    	$users = User::get();
    	return view('user.index', compact('users'));
    }
    public function edit($id)
    {
    	$user = User::find($id);
        //$roleList = ['super_admin' => 'Super Admin', 'ticket_admin' => 'Ticket Admin', 'user' => 'User'];
    	$roleList = ['admin' => 'Admin', 'user' => 'User'];
    	return view('user.edit', compact('user', 'roleList'));
    }
    public function update(Request $request, $id)
    {
    	$user = User::find($id);
        if ($user->id == 1) {
            flash()->error('No permission to update');
            return redirect('user');
        } else {
            $user->name = $request->name;
            $user->role = $request->role;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->save();
            flash()->success('Successfully Updated');
            return redirect('user');
        }
    }
}
