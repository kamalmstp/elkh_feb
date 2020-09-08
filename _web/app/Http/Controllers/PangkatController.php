<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pangkat;

class PangkatController extends Controller
{
    public function __construct()
    {        
        $this->middleware('role:admin'); 
    }
    
    public function list()
    {
   		$pkt_list  = Pangkat::orderBy('created_at', 'DESC')->get();        
        return view('pangkat.list', compact('pkt_list'));
    }

    public function save(Request $request)
    {
    	$input = $request->all();

    	Pangkat::create($input);		

		return redirect()->back()->with('sukses', 'Pangkat "' .$request['pangkat']. '" berhasil ditambah'); 
    }

    public function update(Request $request, $id)
    {
    	$input = $request->all();
    	$pkt = Pangkat::whereId($id)->firstOrfail();

    	$pkt->update($input);

    	return redirect()->back()->with('sukses', 'Pangkat "' .$request['pangkat']. '" berhasil diperbaharui'); 
    }

    public function delete($id)
    {
        $pkt = Pangkat::whereId($id)->firstOrfail();
        $pangkat = $pkt->pangkat;
        $pkt->delete();

        return redirect()->route('pangkat_list')->with('sukses', 'Pangkat "' .$pangkat. '" berhasil dihapus.');
    }
}
