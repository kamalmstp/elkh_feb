<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tahun;

class TahunController extends Controller
{
    public function __construct()
    {        
        $this->middleware('role:admin'); 
    }
    
    public function list()
    {
   		$thn_list  = Tahun::orderBy('created_at', 'DESC')->get();        
        return view('tahun.list', compact('thn_list'));
    }

    public function save(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'tahun' => 'numeric|digits:4|unique:tahun'            
        ]);

        if ($validator->fails()) {
        	$thn_list  = Tahun::orderBy('created_at', 'DESC')->get();        
            return redirect()->route('tahun_list', compact('thn_list'))
                        ->withErrors($validator)
                        ->withInput();
        }

    	$input = $request->all();

    	Tahun::create($input);		

		return redirect()->back()->with('sukses', 'Tahun "' .$request['tahun']. '" berhasil ditambah'); 
    }

    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
            'tahun' => 'numeric|digits:4|unique:tahun'            
        ]);

        if ($validator->fails()) {
        	$thn_list  = Tahun::orderBy('created_at', 'DESC')->get();        
            return redirect()->route('tahun_list', compact('thn_list'))
                        ->withErrors($validator)
                        ->withInput();
        }

    	$input = $request->all();
    	$thn = Tahun::whereId($id)->firstOrfail();

    	$thn->update($input);

    	return redirect()->back()->with('sukses', 'Tahun "' .$request['tahun']. '" berhasil diperbaharui'); 
    }

    public function delete($id)
    {
        $thn = Tahun::whereId($id)->firstOrfail();
        $tahun = $thn->tahun;
        $thn->delete();

        return redirect()->route('tahun_list')->with('sukses', 'Tahun "' .$tahun. '" berhasil dihapus.');
    }
}
