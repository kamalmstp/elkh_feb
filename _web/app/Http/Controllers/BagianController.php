<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bagian;


class BagianController extends Controller
{
    public function __construct()
    {        
        $this->middleware('role:admin'); 
    }
    
    public function list()
    {
   		$bgn_list  = Bagian::orderBy('created_at', 'DESC')->get();        
        return view('bagian.list', compact('bgn_list'));
    }

    public function save(Request $request)
    {
    	$input = $request->all();

    	Bagian::create($input);		

		return redirect()->back()->with('sukses', 'Bagian "' .$request['bagian']. '" berhasil ditambah'); 
    }

    public function update(Request $request, $id)
    {
    	$input = $request->all();
    	$bgn = Bagian::whereId($id)->firstOrfail();

    	$bgn->update($input);

    	return redirect()->back()->with('sukses', 'Bagian "' .$request['bagian']. '" berhasil diperbaharui'); 
    }

    public function delete($id)
    {
        $bgn = Bagian::whereId($id)->firstOrfail();
        $bagian = $bgn->bagian;
        $bgn->delete();

        return redirect()->route('bagian_list')->with('sukses', 'Bagian "' .$bagian. '" berhasil dihapus.');
    }
}
