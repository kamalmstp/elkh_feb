<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use PDF;
use Validator;
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

class SkpController extends Controller
{
  public function __construct()
  {    
      $this->middleware('auth');
  }
    
  public function list()
  {
 		$skp_list  = Skp::whereUser_id(Auth::user()->id)
 						->orderBy('created_at', 'DESC')->get();
    $thn_list = Tahun::orderBy('tahun', 'ASC')->get();
    
    return view('skp.list', compact('skp_list', 'thn_list'));
  }

  public function save(Request $request)
  {

    $input = $request->all();
  	$input['user_id'] = Auth::user()->id;
    $thn = Tahun::whereId($request['tahun_id'])->firstOrfail();

    $validator = Validator::make($input, [
        'tahun_id' => 'unique:skp,tahun_id,null,skp,user_id,'.$input['user_id'],
    ]);
    if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }
    
  	Skp::create($input);		
    $skp = Skp::whereUser_id($input['user_id'])
            ->whereTahun_id($request['tahun_id'])->firstOrfail();
    $id = $skp->id;
	  return redirect()->route('skpkegiatan_list', $id);
  }

  public function update(Request $request, $id)
  {
  	$skp = Skp::whereId($id)->firstOrfail();
  	$input = $request->all();
  	$thn = Tahun::whereId($request['tahun_id'])->firstOrfail();

  	$skp->update($input);

  	return redirect()->back()->with('sukses', 'Tahun SKP berhasil diubah menjadi "'.$thn->tahun.'"');
  }

  public function delete($id)
  {
    $skp = Skp::whereId($id)->firstOrfail();
    $thn = Tahun::whereId($skp->tahun_id)->firstOrfail();
    
    $skp->delete();

    return redirect()->route('skp_list')->with('sukses', 'Data SKP tahun "'.$thn->tahun.'" berhasil dihapus.');
  }

  public function kegiatan_list($id)
  {
    $skp = Skp::whereId($id)->firstOrfail();
    $user_id = Auth::user()->id;

      if ($skp->user->id == $user_id) {
        $skpkeg_list = Skp_kegiatan::whereSkp_id($id)
                      ->orderBy('created_at', 'DESC')->get(); 
        $keg_list = Kegiatan_skp::whereUser_id(Auth::user()->id)->get();           
        $jangka_list = Jangka::get();

        return view('skp.kegiatan_list', compact('skp', 'keg_list', 'skpkeg_list', 'jangka_list'));
      }else{
        abort(403);
      }
  } 

  public function kegiatan_save(Request $request, $id)
  {
    $input = $request->all();
    $input['skp_id'] = $id;
    Skp_kegiatan::create($input);

    $skpkeg = Skp_kegiatan::orderBy('id', 'DESC')->first();
    $jangka_list = Jangka::get();
    foreach($jangka_list as $jangka){
      $tgtinput['skp_id'] = $id;
      $tgtinput['skp_kegiatan_id'] = $skpkeg->id;
      $tgtinput['jangka_id'] = $jangka->id;
      Target::create($tgtinput);  
    }            

    return redirect()->back()->with('sukses', 'Kegiatan SKP baru berhasil ditambah');
  }

  public function kegiatan_update(Request $request, $id)
  {
    $skpkeg = Skp_kegiatan::whereId($id)->firstOrFail();

    $input = $request->all();  
    dd($input); 
    $skpkeg->update($input);

    return redirect()->back()->with('sukses', 'Kegiatan SKP berhasil diubah');
  }

  public function kegiatan_delete($id)
  {
    $skpkeg = Skp_kegiatan::whereId($id)->firstOrFail();
    
    $skpkeg->delete();

    return redirect()->back()->with('sukses', 'kegiatan SKP berhasil dihapus');
  }

  public function target_list($id, $jangka_id)
  {   		
    $skp = Skp::whereId($id)->firstOrfail();  
    $user_id = Auth::user()->id;
    
    if ($skp->user->id == $user_id) {
    $output_list = Satuan::whereSatuan('Output')->get();
    $waktu_list = Satuan::whereSatuan('Waktu')->get();
    $jangka = Jangka::whereId($jangka_id)->firstOrfail();
    $tgt_list = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->get();  

    if ($jangka_id != 1) {
      $tgt_1 = Target::whereSkp_id($id)->whereJangka_id(1)->get();
      foreach ($tgt_1 as $tgt1) {
        if($tgt1->output_id == ''){
          return redirect()->back()->with('gagal', 'Target Kegiatan 1 Tahun belum diisi!');
        }else{
          if ($jangka_id == 2) {
            foreach ($tgt_list as $tgt) {
              if ($tgt->output_id == '') {
                $status = 'no';                  
              }else{
                $status = 'yes';                  
              }
            }
            $tgt_2 = '';              
          }else{
            $tgt_2 = Target::whereSkp_id($id)->whereJangka_id(2)->get();
            foreach ($tgt_2 as $tgt2) {

              if (!is_numeric($tgt2->r_kuantitas)) {
                return redirect()->back()->with('gagal', 'Realisasi Semester 1 belum diisi!');
              }else{
                foreach ($tgt_list as $tgt) {
                  if ($tgt->output_id == '') {
                    $status = 'no';                  
                  }else{
                    $status = 'yes';                  
                  }
                }
              }
            }
          }          
        }
      }
    }else{
      $status = 'yes';
      $tgt_1  = '';
      $tgt_2  = '';
    }
    
    return view('skp.target_list', compact('tgt_list', 'tgt_1', 'tgt_2', 'output_list', 'waktu_list', 'jangka', 'skp', 'status', 'target1'));

    }else{
      abort(403);
    }

  }

  public function target_update(Request $request, $id, $jangka_id)
  {  		  	
    $cyldata = $request->all();
    $num_elements = 0;
    $sqlData = array();
    while($num_elements < count($cyldata['ak'])){
        $sqlData[] = array(
            'target_id'     => $cyldata['target_id'][$num_elements],
            'ak'            => $cyldata['ak'][$num_elements],
            'kuantitas'     => $cyldata['kuantitas'][$num_elements],
            'output_id'     => $cyldata['output_id'][$num_elements],
            'mutu'          => $cyldata['mutu'][$num_elements],
            'waktu'         => $cyldata['waktu'][$num_elements], 
            'waktu_id'      => $cyldata['waktu_id'][$num_elements],               
            'biaya'         => $cyldata['biaya'][$num_elements],               
        );
        $num_elements++;
    }

    foreach ($sqlData as $data) {        
      $input['ak'] = $data['ak'];
      $input['kuantitas'] = $data['kuantitas'];
      $input['output_id'] = $data['output_id'];
      $input['mutu'] = $data['mutu'];
      $input['waktu'] = $data['waktu'];
      $input['waktu_id'] = $data['waktu_id'];
      $input['biaya'] = $data['biaya'];

      DB::table('target')->where('id', (int)$data['target_id'])
                        ->update($input);
    }

    return redirect()->back()->with('sukses', 'Target kegiatan SKP berhasil perbaharui');
  }

  public function target_pdf(Request $request, $id, $jangka_id)
  {
    $skp = Skp::whereId($id)->firstOrfail();
    $user_id = Auth::user()->id; 
    
      if ($skp->user->id == $user_id) {        

        $tgt_list = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->get();  
        $jangka = Jangka::whereId($jangka_id)->firstOrfail();
        $tgl_ttd = date_format(date_create($request['ttd']), "j");
        $bln_ttd = date_format(date_create($request['ttd']), "n");
        $thn_ttd = date_format(date_create($request['ttd']), "Y");
        $blnList = array(           
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        foreach($tgt_list as $tgt){
          if ($tgt->output_id == '') {
            return redirect()->back()->with('gagal', 'NIlai target {$jangka->jangka} belum diisi!');
          }else{
            $pdf = PDF::loadView('skp.target_pdf', 
                    compact('skp', 'jangka', 'tgt_list', 'blnList', 'tgl_ttd', 'bln_ttd', 'thn_ttd'))
                    ->setPaper('a4', 'landscape');

            return $pdf->stream('Target SKP '.$jangka->jangka.'.pdf');
          }
        }     

      }else{
        abort(403);
      }
  }

  public function realisasi_jangka($id)
  {
 		$skp = Skp::whereId($id)->firstOrfail();
 		$jangka_list = Jangka::get();

 		return view('skp.realisasi_jangka', compact('skp', 'jangka_list'));
  } 

  public function realisasi_list($id, $jangka_id)
  {
    $skp = Skp::whereId($id)->firstOrfail();
    $user_id = Auth::user()->id; 
    
    if ($skp->user->id == $user_id) {     

    $tgt_list = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
    $jangka = Jangka::whereId($jangka_id)->firstOrfail();

    if ($jangka_id == 1) {
      $tambahan_list = Tambahan::whereSkp_id($id)->get();
      $tgt_3 = Target::whereSkp_id($id)->whereJangka_id(3)->get();
      foreach ($tgt_3 as $tgt3) {          
        if ($tgt3->r_kuantitas == '') {
          return redirect()->back()->with('gagal', 'Realisasi Semester 2 belum diisi!');
        }else{
          foreach ($tgt_list as $tgt) {
            if ($tgt->r_kuantitas == '') {
              $status = 'no';                  
              $tgt_2 = Target::whereSkp_id($id)->whereJangka_id(2)->get();
              $tgt_3 = Target::whereSkp_id($id)->whereJangka_id(3)->get();
            }else{
              $status = 'yes';                  
            }
          }                     
        }
      }
    }else{
      foreach ($tgt_list as $tgt) {
        if ($tgt->output_id == '') {
          return redirect()->back()->with('gagal', 'Data Target belum diisi!');
        }else{
          $status = 'yes';                  
        }
      }
      $tambahan_list = Tambahan::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
    }
    
    return view('skp.realisasi_list', compact('tgt_list','skp', 'jangka', 'status', 'tgt_2', 'tgt_3', 'tambahan_list'));
    
    }else{
      abort(403);
    }

  }

  public function realisasi_update(Request $request, $id, $jangka_id)
  {         
    $cyldata = $request->all();
    $num_elements = 0;
    $sqlData = array();
    while($num_elements < count($cyldata['r_ak'])){
        $sqlData[] = array(
            'target_id'     => $cyldata['target_id'][$num_elements],
            'r_ak'            => $cyldata['r_ak'][$num_elements],
            'r_kuantitas'     => $cyldata['r_kuantitas'][$num_elements],              
            'r_mutu'          => $cyldata['r_mutu'][$num_elements],
            'r_waktu'         => $cyldata['r_waktu'][$num_elements],               
            'r_biaya'         => $cyldata['r_biaya'][$num_elements],               
            't_kuantitas'     => $cyldata['t_kuantitas'][$num_elements],              
            't_mutu'          => $cyldata['t_mutu'][$num_elements],
            't_waktu'         => $cyldata['t_waktu'][$num_elements],               
            't_biaya'         => $cyldata['t_biaya'][$num_elements],               
        );
        $num_elements++;
    }
    // dd($sqlData);
    foreach ($sqlData as $data) {        
      $input['r_ak']  = $data['r_ak'];
      $r_kuantitas  = $input['r_kuantitas'] = $data['r_kuantitas'];        
      $r_mutu       = $input['r_mutu']      = $data['r_mutu'];
      $r_waktu      = $input['r_waktu']     = $data['r_waktu'];
      $r_biaya      = $input['r_biaya']     = $data['r_biaya'];
      $t_kuantitas  = $data['t_kuantitas'];
      $t_mutu       = $data['t_mutu'];
      $t_waktu      = $data['t_waktu'];
      $t_biaya      = $data['t_biaya'];

      if ($t_waktu == 0) {
        $waktu = 0;
      }else{
        $p_waktu   = 100 - ($r_waktu/$t_waktu*100);
        $waktu_l   = 76 - ( ( ( (1.76*$t_waktu-$r_waktu) / $t_waktu) * 100) - 100);
        $waktu_k   = ( (1.76*$t_waktu-$r_waktu) / $t_waktu) * 100;
        if ($p_waktu > 24 ) {
          $waktu = $waktu_l;
        }else{
          $waktu = $waktu_k;
        }        
      }

      if ($t_biaya == '' || $r_biaya == '' || $t_biaya == 0) {
        $biaya = 0;
      }else{
        $p_biaya   = 100 - ($r_biaya/$t_biaya*100);
        $biaya_l   = 76 - ( ( ( (1.76*$t_biaya-$r_biaya) / $t_biaya) * 100) - 100);
        $biaya_k   = ( (1.76*$t_biaya-$r_biaya) / $t_biaya) * 100;
        if ($p_biaya > 24 ) {
          $biaya = $biaya_l;
        }else{
          $biaya = $biaya_k;
        }  
      }      

      if ($t_kuantitas == 0) {
        $kuantitas = 0;
      }else{
        $kuantitas = $r_kuantitas / $t_kuantitas * 100;
      }
      
      if ($t_mutu == 0) {
        $mutu = 0;
      }else{
        $mutu = $r_mutu / $t_mutu * 100;  
      }
      
      $perhitungan = $input['perhitungan'] = $kuantitas + $mutu + $waktu + $biaya;
      $input['capaian'] = $perhitungan / 3;
      // dd($input);
      DB::table('target')->where('id', (int)$data['target_id'])
                        ->update($input);
    }

    return redirect()->back()->with('sukses', 'Realisasi SKP berhasil perbaharui');
  }    

  public function tambahan_list($id, $jangka_id)
  {       
    $skp = Skp::whereId($id)->firstOrfail(); 
    $user_id = Auth::user()->id; 
    
      if ($skp->user->id == $user_id) {                     
        $jangka = Jangka::whereId($jangka_id)->firstOrfail();
        $tambahan_list = Tambahan::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
      }else{
        abort(403);
      }

    return view('skp.tambahan_list', compact('skp', 'jangka', 'tambahan_list'));
  }

  public function tambahan_save(Request $request, $id, $jangka_id)
  {
    $input['skp_id'] = $id;
    $input['jangka_id'] = $jangka_id;
    $input['tugas'] = $request['tugas'];
    
    Tambahan::create($input);    

    return redirect()->back()->with('sukses', 'Tugas Tambahan baru berhasil ditambahkan');
  }

  public function tambahan_update(Request $request, $id)
  {
    $input['tugas'] = $request['tugas'];
    
    $tambahan = Tambahan::whereId($id)->firstOrfail();    
    $tambahan->update($input);
    
    return redirect()->back()->with('sukses', 'Tugas Tambahan berhasil diperrbaharui');
  }

  public function tambahan_delete($id)
  {
    $tambahan = Tambahan::whereId($id)->firstOrFail();
    
    $tambahan->delete();

    return redirect()->back()->with('sukses', 'Tugas Tambahan berhasil dihapus');
  }

  public function realisasi_pdf(Request $request, $id, $jangka_id)
  {
    $skp = Skp::whereId($id)->firstOrfail();
    $user_id = Auth::user()->id; 
    
    if ($skp->user->id == $user_id) {  
    
    $tgt_list = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->get();  
    $jangka = Jangka::whereId($jangka_id)->firstOrfail();

    if ($jangka_id == 1) {
      $tambahan_list = Tambahan::whereSkp_id($id)->get();
    }else{
      $tambahan_list = Tambahan::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
    }

    foreach($tgt_list as $tgt){
      if ($tgt->r_kuantitas == '') {
        return redirect()->back()->with('gagal', 'NIlai realisasi {$jangka->jangka} belum diisi!');
      }else{
        $j_target = count($tgt_list);
        $j_tambahan = count($tambahan_list);

        if ($j_tambahan >= 1 && $j_tambahan <= 3) {
          $n_tambahan = 1;
        }elseif ($j_tambahan > 3 && $j_tambahan <= 7) {
          $n_tambahan = 2;
        }elseif ($j_tambahan > 7) {
          $n_tambahan = 3;
        }else{
          $n_tambahan = 0;
        }
        
        $t_nilai = 0;
        $j_nilai0 = 0;
        foreach ($tgt_list as $tgt) {
          $t_nilai += $tgt->capaian;
          if ($tgt->capaian == 0) {
            $j_nilai0++;
          }
        }
        
        $nilai_capaian = $t_nilai / ($j_target - $j_nilai0) + $n_tambahan;

        if ($nilai_capaian <= 50) {
          $kat = 'Buruk';
        }elseif ($nilai_capaian <= 60) {
          $kat = 'Sedang';
        }elseif ($nilai_capaian <= 75) {
          $kat = 'Cukup';
        }elseif ($nilai_capaian <= 90.99) {
          $kat = 'Baik';
        }else{
          $kat = 'Sangat Baik';
        }

        $tgl_start = date_format(date_create($request['start']), "d"); 
        $bln_start = date_format(date_create($request['start']), "n"); 
        $tgl_end = date_format(date_create($request['end']), "d"); 
        $bln_end = date_format(date_create($request['end']), "n"); 
        $thn_end = date_format(date_create($request['end']), "Y"); 
        $tgl_ttd = date_format(date_create($request['ttd']), "j");
        $bln_ttd = date_format(date_create($request['ttd']), "n");
        $thn_ttd = date_format(date_create($request['ttd']), "Y");
        $blnList = array(           
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $pdf = PDF::loadView('skp.realisasi_pdf', 
                compact('skp', 'jangka', 'tgt_list', 'tambahan_list','n_tambahan', 'nilai_capaian', 'kat', 'blnList', 'tgl_ttd', 'bln_ttd', 'thn_ttd', 'tgl_start', 'bln_start', 'tgl_end', 'bln_end', 'thn_end'))
                ->setPaper('a4', 'landscape');
        return $pdf->stream('Realisasi SKP '.$jangka->jangka.'.pdf');
      }
    }     

    }else{
      abort(403);
    }

  }

  public function penilaian_list($id, $jangka_id)
  {       
    $skp = Skp::whereId($id)->firstOrfail(); 
    $user_id = Auth::user()->id; 
    $atasan_id = Auth::user()->atasan->id; 
    
    if ($skp->user->id == $user_id || $skp->user->atasan->id == $user_id) {  

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
          $input['status'] = 1;
          Penilaian::create($input);          
        }
        return view('skp.penilaian_list', compact('skp', 'jangka', 'penilaian_list', 'rw_penilaian', 'jangka_list', 'thn_list'));
      }else{
        return view('skp.penilaian_list', compact('skp', 'jangka', 'penilaian_list', 'rw_penilaian', 'jangka_list', 'thn_list'));
      }
    }else{
      return redirect()->back()->with('gagal', "Realisasi {$jangka->jangka} belum diisi!");
    }

    }else{
      abort(403);
    }   
  }

  public function penilaian_update(Request $request, $id, $jangka_id)
  {         
    if ($request['form'] == 'penilaian') {
      $cyldata = $request->all();
      $num_elements = 0;
      $sqlData = array();
      while($num_elements < count($cyldata['nilai'])){
          $sqlData[] = array(
              'penilaian_id'  => $cyldata['penilaian_id'][$num_elements],
              'nilai'         => $cyldata['nilai'][$num_elements],            
          );
          $num_elements++;
      }
      foreach ($sqlData as $data) {              
        $input['nilai'] =  $nilai = $data['nilai'];
        if ($nilai == '') {
          $kat_id = 6;
        }elseif ($nilai <= 50) {
          $kat_id = 1;
        }elseif ($nilai <= 60) {
          $kat_id = 2;
        }elseif ($nilai <= 75) {
          $kat_id = 3;
        }elseif ($nilai <= 90) {
          $kat_id = 4;
        }elseif ($nilai <= 100){
          $kat_id = 5;
        }
        $input['kategori_id'] = $kat_id;
        DB::table('penilaian')->where('id', (int)$data['penilaian_id'])->update($input);
      }
      
      return redirect()->back()->with('sukses', 'Nilai Perilaku Kerja berhasil perbaharui');  
    
    }else{
      $skp = Skp::whereId($id)->firstOrfail();
      $jangka = Jangka::whereId($jangka_id)->firstOrfail();      
      $penilaian_list = Penilaian::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
      $jangka_list = Jangka::get();
      $thn_list = Tahun::orderBy('tahun', 'ASC')->get();

      $rw_skp = Skp::whereTahun_id($request['rwtahun_id'])->whereUser_id($skp->user->id)->first(); 
      $rw_jangka = Jangka::whereId($request['rwjangka_id'])->firstOrfail();      
      
      if ($rw_skp == null) {
       return redirect()->back()->with('gagal', "Riwayat Penilaian Tahun Tidak Ditemukan");
      }else{
        $rw_penilaian = Penilaian::whereSkp_id($rw_skp->id)->whereJangka_id($rw_jangka->id)->get();
        if (Auth::user()->id == $skp->user->id) {
          return view('skp.penilaian_list', compact('skp', 'jangka', 'penilaian_list', 'jangka_list', 'thn_list', 'rw_penilaian', 'rw_jangka', 'rw_skp'));
        }else{
          return view('bawahan.penilaianb_list', compact('skp', 'jangka', 'penilaian_list', 'jangka_list', 'thn_list', 'rw_penilaian', 'rw_jangka', 'rw_skp'));
        }  
      }
      
      
    }
    
  }

  public function penilaian_pdf(Request $request, $id, $jangka_id)
  {
    $skp = Skp::whereId($id)->firstOrfail();             
    $user_id = Auth::user()->id; 
    
    if ($skp->user->id == $user_id || $skp->user->atasan->id == $user_id || $skp->user->atasan->atasan->id == $user_id) {  

    $tgt_list = Target::whereSkp_id($id)->whereJangka_id($jangka_id)->get();       
    $jangka = Jangka::whereId($jangka_id)->firstOrfail();
    $penilaian_list = Penilaian::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
    
    if ($jangka_id == 1) {
      $tambahan_list = Tambahan::whereSkp_id($id)->get();
    }else{
      $tambahan_list = Tambahan::whereSkp_id($id)->whereJangka_id($jangka_id)->get();
    }
    
    $j_target = count($tgt_list);
    $j_tambahan = count($tambahan_list);

    if ($j_tambahan >= 1 && $j_tambahan <= 3) {
      $n_tambahan = 1;
    }elseif ($j_tambahan > 3 && $j_tambahan <= 7) {
      $n_tambahan = 2;
    }elseif ($j_tambahan > 7) {
      $n_tambahan = 3;
    }else{
      $n_tambahan = 0;
    }
    
    $t_nilai = 0;
    foreach ($tgt_list as $tgt) {
      $t_nilai += $tgt->capaian;
    }
    
    $nilai_capaian = $t_nilai / $j_target + $n_tambahan;
    $p_skp = $nilai_capaian * 60 / 100;

    $j_nilai = 0;
    $j_nilai0 = 0;
    foreach ($penilaian_list as $penilaian) {
      $j_nilai += $penilaian->nilai; 
      if ($penilaian->nilai == '') {
        $j_nilai0++;
      }
    }

    if (count($penilaian_list) == $j_nilai0) {
      return redirect()->back()->with('gagal', "Nilai Perilaku Kerja tidak boleh kosong! ");
    }

    $r_nilai = $j_nilai / (count($penilaian_list) - $j_nilai0);
    $n_perilaku = $r_nilai * 40 / 100;

    $n_prestasi = $p_skp + $n_perilaku;
    if ($n_prestasi <= 50) {
      $kat = 'Buruk';
    }elseif ($n_prestasi <= 60) {
      $kat = 'Sedang';
    }elseif ($n_prestasi <= 75) {
      $kat = 'Cukup';
    }elseif ($n_prestasi <= 90.99) {
      $kat = 'Baik';
    }else{
      $kat = 'Sangat Baik';
    }

    $tgl_start = date_format(date_create($request['start']), "d"); 
    $bln_start = date_format(date_create($request['start']), "n"); 
    $tgl_end = date_format(date_create($request['end']), "d"); 
    $bln_end = date_format(date_create($request['end']), "n"); 
    $thn_end = date_format(date_create($request['end']), "Y"); 
    $tgl_ttd1 = date_format(date_create($request['ttd1']), "j");
    $bln_ttd1 = date_format(date_create($request['ttd1']), "n");
    $thn_ttd1 = date_format(date_create($request['ttd1']), "Y");
    $tgl_ttd2 = date_format(date_create($request['ttd2']), "j");
    $bln_ttd2 = date_format(date_create($request['ttd2']), "n");
    $thn_ttd2 = date_format(date_create($request['ttd2']), "Y");
    $tgl_ttd3 = date_format(date_create($request['ttd3']), "j");
    $bln_ttd3 = date_format(date_create($request['ttd3']), "n");
    $thn_ttd3 = date_format(date_create($request['ttd3']), "Y");
    $blnList = array(           
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );

    $pdf = PDF::loadView('skp.penilaian_pdf', 
            compact('skp', 'jangka', 'penilaian_list','nilai_capaian', 'p_skp', 'j_nilai', 'r_nilai', 'n_perilaku', 'n_prestasi', 'kat', 'blnList', 'tgl_start', 'bln_start', 'tgl_end', 'bln_end', 'thn_end', 'tgl_ttd1', 'bln_ttd1', 'thn_ttd1', 'tgl_ttd2', 'bln_ttd2', 'thn_ttd2', 'tgl_ttd3', 'bln_ttd3', 'thn_ttd3'))
            ->setPaper('a4', 'portrait');
    return $pdf->stream('Penilaian SKP '.$jangka->jangka.'.pdf');
  
    }else{
        abort(403);
    }

  }

}

