<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lkh;
use App\Kegiatan_lkh;
use Validator;
use Carbon;
use Auth;
use PDF;

class LkhController extends Controller
{
    public function __construct()
    {    
        $this->middleware('auth');
    }

    public function list()
    {
	   $list_lkh  = Lkh::whereUser_id(Auth::user()->id)->orderBy('tanggal', 'DESC')->get();        
   		$dayList = array(			
			'1' => 'Senin',
			'2' => 'Selasa',
			'3' => 'Rabu',
			'4' => 'Kamis',
			'5' => 'Jumat',
			'6' => 'Sabtu',
			'7' => 'Minggu'
		);
        return view('lkh.list', compact('list_lkh', 'dayList'));
    }

    public function save(Request $request)
    {
        $input['user_id'] = $user_id = Auth::user()->id;   	
   		$input['tanggal'] = date_format(date_create($request['tanggal']), "Y-m-d");
        $tanggal = date_format(date_create($request['tanggal']), "d/m/Y");
    
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $today = Carbon::now();
        $awalm = $today->startOfWeek();
        $today2 = Carbon::now();
        $akhirm = $today2->endOfWeek();        
        // dd($awalm, $akhirm);

        $validator = Validator::make($input, [
            'tanggal' => 'after:'.$awalm.'|before:'.$akhirm.'
                            |unique:lkh,tanggal,null,lkh,user_id,'.$user_id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
		
        Lkh::create($input);		

		return redirect()->back()->with('sukses', 'LKH tanggal "' .$tanggal. '" berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
    	$lkh = Lkh::whereId($id)->firstOrfail();
    	$input['tanggal'] = date_format(date_create($request['tanggal']), "Y-m-d");
    	$input['user_id'] = $user_id = Auth::user()->id;    
        $tanggal = date_format(date_create($request['tanggal']), "d/m/Y");
    
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $today = Carbon::now();
        $awalm = $today->startOfWeek();
        $today2 = Carbon::now();
        $akhirm = $today2->endOfWeek();

        $validator = Validator::make($input, [
            'tanggal' => 'after:'.$awalm.'|before:'.$akhirm.'
                            |unique:lkh,tanggal,null,lkh,user_id,'.$user_id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$lkh->update($input);

    	return redirect()->back()->with('sukses', 'Tanggal LKH berhasil diubah menjadi "' .$tanggal.'"');
    }

    public function delete($id)
    {
        $lkh = Lkh::whereId($id)->firstOrFail();
        $tanggal = date_format(date_create($lkh->tanggal), "d/m/Y");
        
        $lkh->delete();

        return redirect()->route('lkh_list')->with('sukses', 'Data LKH tanggal "' .$tanggal. '" berhasil dihapus.');
    }

    public function detail($id)
    {
   		$lkh = Lkh::whereId($id)->firstOrFail();
        $user_id = Auth::user()->id;

        if ($lkh->user->id == $user_id) {
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
            return view('lkh.detail', compact('lkh', 'tanggal', 'kegiatan_list', 'hari', 'dayList'));
        }else{
            abort(403);
        }
    }

    public function detail_save(Request $request, $id)
    {
    	$input = $request->all();

    	$input['lkh_id'] = $id;

    	Kegiatan_lkh::create($input);

    	return redirect()->back()->with('sukses', 'Kegiatan baru berhasil ditambah');
    }

    public function detail_update(Request $request, $id)
    {
		$kegiatan = Kegiatan_lkh::whereId($id)->firstOrFail();

		$input = $request->all();		
		$kegiatan->update($input);

    	return redirect()->back()->with('sukses', 'Kegiatan berhasil diubah');
	}

	public function detail_delete($id)
    {
        $kegiatan = Kegiatan_lkh::whereId($id)->firstOrFail();
        
        $kegiatan->delete();

        return redirect()->back()->with('sukses', 'Kegiatan berhasil dihapus');
    }

    public function pdf(Request $request)
    {
        $lkh_id = $request['lkh_id'];
        $lkh = Lkh::whereId($lkh_id)->firstOrFail();
        $kegiatan_list = Kegiatan_lkh::whereLkh_id($lkh_id)->orderBy('created_at', 'asc')->get();
        $tanggal = date_format(date_create($lkh->tanggal), "d/m/Y");
        $tgl = date_format(date_create($lkh->tanggal), "dmy");
        $hari = date_format(date_create($lkh->tanggal), "N");
        $tgl_ttd = date_format(date_create($request['ttd']), "j");
        $bln_ttd = date_format(date_create($request['ttd']), "n");
        $thn_ttd = date_format(date_create($request['ttd']), "Y");
        $dayList = array(           
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => 'Jumat',
            '6' => 'Sabtu',
            '7' => 'Minggu'
        );
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

        $pdf = PDF::loadView('lkh.pdf', 
                compact('lkh', 'tanggal', 'kegiatan_list', 'hari', 'dayList', 'blnList', 'tgl_ttd', 'bln_ttd', 'thn_ttd'))
                ->setPaper('a4', 'landscape');

        return $pdf->stream('LKH '.$tgl.'.pdf');
        
    }

    public function pdf2(Request $request)
    {       
        $bt = $request['bulan'];
        $bulan = date_format(date_create($bt), "n");
        $tahun = date_format(date_create($bt), "Y");
        $tgl_ttd = date_format(date_create($request['ttd']), "j");
        $bln_ttd = date_format(date_create($request['ttd']), "n");
        $thn_ttd = date_format(date_create($request['ttd']), "Y");
        $dayList = array(           
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => 'Jumat',
            '6' => 'Sabtu',
            '7' => 'Minggu'
        );
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
        
        if ($request['user'] == 'atasan') {
            $user_id = $request['user_id'];
        }else{
            $user_id = Auth::user()->id;
        }
        $lkh_list = Lkh::whereUser_id($user_id)->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)->orderBy('tanggal', 'ASC')->get();

        $pdf = PDF::loadView('lkh.pdf2', 
                compact('lkh_list','tahun', 'bulan', 'dayList', 'blnList', 'tgl_ttd', 'bln_ttd', 'thn_ttd'))
                ->setPaper('a4', 'portrait');

        return $pdf->stream('LKH '.$blnList[$bulan].' '.$tahun.'.pdf');

    }
}
