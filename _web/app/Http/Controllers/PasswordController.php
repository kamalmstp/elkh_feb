<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Validator;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
	public function __construct()
    {    
        $this->middleware('auth');
    }

    public function index()
    {
        return view('password.index');
    }

    public function save(Request $request)
    {
    	$user = User::whereId(Auth::user()->id)->firstOrFail(); 
    	
    	$validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $input['password'] = bcrypt($request['password']);    
    	$user->update($input);

		return redirect()->back()->with('sukses', 'Password berhasil diubah'); 
    }
}
