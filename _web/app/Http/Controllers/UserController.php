<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Pangkat;
use App\Bagian;

class UserController extends Controller
{
    public function __construct()
    {        
        $this->middleware('role:admin'); 
    }
    
    public function list()
    {
    	$user_list  = User::get();  

    	return view('user.list', compact('user_list'));      
    }

    public function add()
    {
        $user_list  = User::where('id', '>', 1)->get();
        $pkt_list = Pangkat::orderBy('golongan', 'desc')->get();
        $bgn_list = Bagian::get();
        
    	return view('user.add', compact('user_list', 'pkt_list', 'bgn_list'));      
    }

    public function save(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',            
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->route('user_add')
                        ->withErrors($validator)
                        ->withInput();
        }

        $input = $request->all();
     	$input['password'] = bcrypt($request['password']);    
   		
        
   		User::create($input);		
		
		return redirect()->route('user_list')->with('sukses', 'User "' .$request['name']. '" berhasil ditambah');
    }

    public function edit($id)
    {
        $user = User::whereId($id)->firstOrFail(); 
        $user_list  = User::where('id', '>', 1)->get();
        $pkt_list = Pangkat::orderBy('golongan', 'desc')->get();
        $bgn_list = Bagian::get();

        return view('user.edit', compact('user' ,'user_list', 'pkt_list', 'bgn_list'));      
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $user = User::whereId($id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'email' => 'string|email|max:255|unique:users,email,' .$user->id,            
        ]);

        if ($validator->fails()) {
            return redirect()->route('user_edit', $id)
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request['password'] == '') {
            $input['password'] = $user->password;            
        }else{
            $validator = Validator::make($request->all(), [
                'password' => 'string|min:6|confirmed',
            ]);
            
            if ($validator->fails()) {
                return redirect()->route('user_edit', $id)
                            ->withErrors($validator)
                            ->withInput();
            }else{
                $input['password'] = bcrypt($request['password']);
            }
        }
        
        $user->update($input);

        return redirect()->route('user_list')->with('sukses', 'Data "' .$input['name'].'" berhasil diperbaharui.');
    }

    public function delete($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $nama = $user->name;

        $user->delete();

        return redirect()->route('user_list')->with('sukses', 'User "' .$nama. '" berhasil dihapus.');
    }




}
