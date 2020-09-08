<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Satuan;

class SatuanController extends Controller
{
    public function __construct()
    {        
        $this->middleware('role:admin'); 
    }
    
    public function list()
    {
   		$satuan_list  = Satuan::orderBy('created_at', 'DESC')->get();        
        return view('satuan.list', compact('satuan_list'));
    }

    public function save(Request $request)
    {
    	$input = $request->all();

    	Satuan::create($input);		

		return redirect()->back()->with('sukses', 'Satuan "' .$request['nama']. '" berhasil ditambah'); 
    }

    public function update(Request $request, $id)
    {
    	$input = $request->all();
    	$satuan = Satuan::whereId($id)->firstOrfail();

    	$satuan->update($input);

    	return redirect()->back()->with('sukses', 'Satuan "' .$request['nama']. '" berhasil diperbaharui'); 
    }

    public function delete($id)
    {
        $satuan = Satuan::whereId($id)->firstOrfail();
        $nama = $satuan->nama;
        $satuan->delete();

        return redirect()->route('satuan_list')->with('sukses', 'Pangkat "' .$nama. '" berhasil dihapus.');
    }
}
