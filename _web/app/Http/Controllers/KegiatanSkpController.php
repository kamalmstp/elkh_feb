<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kegiatan_skp;
use Auth;

class KegiatanSkpController extends Controller
{
    public function __construct()
    {    
        $this->middleware('auth');
    }
    
    public function list()
    {
   		$keg_list  = Kegiatan_skp::whereUser_id(Auth::user()->id)->
                        orderBy('created_at', 'DESC')->get();        
        return view('kegiatan.list', compact('keg_list'));
    }

    public function save(Request $request)
    {
    	$input = $request->all();

    	Kegiatan_skp::create($input);		

		return redirect()->back()->with('sukses', 'Kegiatan baru berhasil ditambah'); 
    }

    public function update(Request $request, $id)
    {
    	$input = $request->all();
    	$keg = Kegiatan_skp::whereId($id)->firstOrfail();

    	$keg->update($input);

    	return redirect()->back()->with('sukses', 'Kegiatan berhasil diperbaharui'); 
    }

    public function delete($id)
    {
        $keg = Kegiatan_skp::whereId($id)->firstOrfail();        
        $keg->delete();

        return redirect()->route('kegiatan_list')->with('sukses', 'Kegiatan berhasil dihapus.');
    }
}
