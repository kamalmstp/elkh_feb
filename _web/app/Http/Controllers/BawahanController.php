<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Lkh;
use App\Kegiatan_lkh;
use App\Skp;
use App\Target;
use App\Tahun;
use App\Jangka;
use App\Kegiatan_skp;
use App\Satuan;
use App\Skp_kegiatan;
use App\Tambahan;
use App\Penilaian;
use App\Perilaku;
use App\Kategori;

class BawahanController extends Controller
{
  public function __construct()
    {    
        $this->middleware('auth');
    }
    
  public function list()
  {
  	$bawahan_list = User::whereAtasan_id(Auth::user()->id)->get();  

  	return view('bawahan.list', compact('bawahan_list'));      
  }

  public function lkhb_list($id)
  {
  	$user = User::whereId($id)->firstOrfail();
 		$list_lkh  = Lkh::whereUser_id($id)->orderBy('tanggal', 'DESC')->get();        
 		$dayList = array(			
		'1' => 'Senin',
		'2' => 'Selasa',
		'3' => 'Rabu',
		'4' => 'Kamis',
		'5' => 'Jumat',
		'6' => 'Sabtu',
		'7' => 'Minggu'
	);
      return view('bawahan.lkhb_list', compact('list_lkh', 'dayList', 'user'));
  }

  public function lkhb_detail($id)
  {    	
 		$lkh = Lkh::whereId($id)->firstOrFail();
 		$user = $lkh->user;
 		$kegiatan_list = Kegiatan_lkh::whereLkh_id($id)->orderBy('created_at', 'desc')->get();
 		$tanggal = date_format(date_create($lkh->tanggal), "d/m/Y");
 		$hari = date_format(date_create($lkh->tanggal), "N");
 		$dayList = array(			
		'1' => 'Senin',
		'2' => 'Selasa',
		'3' => 'Rabu',
		'4' => 'Kamis',
		'5' => 'Jumat',
		'6' => 'Sabtu',
		'7' => 'Minggu'
	);
      return view('bawahan.lkhb_detail', compact('lkh', 'tanggal', 'kegiatan_list', 'hari', 'dayList', 'user'));
  }

  public function skpb_list($id)
  {
    $skp_list  = Skp::whereUser_id($id)
            ->orderBy('created_at', 'DESC')->get();
    $thn_list = Tahun::orderBy('tahun', 'ASC')->get();      
    
    return view('bawahan.skpb_list', compact('skp_list', 'thn_list'));
  }

  public function targetb_jangka($id)
  {
    $skp = Skp::whereId($id)->firstOrfail();
    $skpkeg_list = Skp_kegiatan::whereSkp_id($id)
                  ->orderBy('created_at', 'DESC')->get();     
    $jangka_list = Jangka::get();

    return view('bawahan.targetb_jangka', compact('skp', 'skpkeg_list', 'jangka_list'));
  }

  public function targetb_list($id, $jangka_id)
  {
    $skp = Skp::whereId($id)->firstOrfail();                     
    $jangka = Jangka::whereId($jangka_id)->firstOrfail();
    $tgt_list = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->get(); 

    foreach ($tgt_list as $tgt) {
       if ($tgt->output_id == '') {
          return redirect()->back()->with('gagal', "Target {$jangka->jangka} belum diisi!");
       }else{
          return view('bawahan.targetb_list', compact('tgt_list', 'jangka', 'skp'));
       }
     } 
    
    
  }
  
  public function realisasib_jangka($id)
  {
    $skp = Skp::whereId($id)->firstOrfail();
    $jangka_list = Jangka::get();

    return view('bawahan.realisasib_jangka', compact('skp', 'jangka_list'));
  }

  public function realisasib_list($id, $jangka_id)
  {
    $skp = Skp::whereId($id)->firstOrfail();
    $tgt_list = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
    $jangka = Jangka::whereId($jangka_id)->firstOrfail();
    
    if ($jangka_id == 1) {
      $tambahan_list = Tambahan::whereSkp_id($id)->get();
    }else{
      $tambahan_list = Tambahan::whereSkp_id($id)->whereJangka_id($jangka_id)->get();  
    }
    
    return view('bawahan.realisasib_list', compact('tgt_list','skp', 'jangka', 'tambahan_list'));
  }

  public function realisasib_status(Request $request, $id, $jangka_id)
  {
    $tgt_list = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->get();

    foreach ($tgt_list as $tgt) {
      $input['status'] = $request['status'];
      $tgt->update($input);
    }

    return redirect()->back()->with('suskes', "Status berhasil diubah");
  }

  public function penilaianb_list($id, $jangka_id)
  {       
    $skp = Skp::whereId($id)->firstOrfail();                    
    $tgt = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->first();
    $jangka = Jangka::whereId($jangka_id)->firstOrfail();
    $perilaku_list = Perilaku::get();
    $penilaian_list = Penilaian::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
    $jangka_list = Jangka::get();
    $thn_list = Tahun::orderBy('tahun', 'ASC')->get();
    $rw_penilaian = '';
    
    if ($tgt) {  
      if ($tgt->r_kuantitas == '') {
        return redirect()->back()->with('gagal', "Realisasi {$jangka->jangka} belum diisi!");
      }elseif (count($penilaian_list) == 0) {
        $input['skp_id'] = $id;
        $input['jangka_id'] = $jangka_id;
        foreach($perilaku_list as $perilaku){
          $input['perilaku_id'] = $perilaku->id;
          $input['kategori_id'] = 6;
          Penilaian::create($input);          
        }
        return view('bawahan.penilaianb_list', compact('skp', 'jangka', 'penilaian_list', 'rw_penilaian', 'jangka_list', 'thn_list'));
      }else{
        return view('bawahan.penilaianb_list', compact('skp', 'jangka', 'penilaian_list', 'rw_penilaian', 'jangka_list', 'thn_list'));
      }
    }else{
      return redirect()->back()->with('gagal', "Realisasi {$jangka->jangka} belum diisi!");
    }  
  }

  public function penilaianb_status(Request $request, $id, $jangka_id)
  {
    $penilaian_list = Penilaian::whereSkp_id($id)->whereJangka_id($jangka_id)->get();

    foreach ($penilaian_list as $penilaian) {
      $input['status'] = $request['status'];
      $penilaian->update($input);
    }

    return redirect()->back()->with('suskes', "Status berhasil diubah");
  }

}
