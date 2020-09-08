<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'target';

	protected $fillable = ['skp_id', 'skp_kegiatan_id', 'jangka_id',  'ak', 'kuantitas', 
							'output_id', 'mutu', 'waktu', 'waktu_id', 'biaya' , 'r_ak', 
							'r_kuantitas', 'r_mutu', 'r_waktu', 'r_biaya', 'perhitungan', 'capaian', 'status'];

	public function skp()
	{
		return $this->belongsTo('App\Skp', 'skp_id');
	}

	public function skpkegiatan()
	{
		return $this->belongsTo('App\Skp_kegiatan', 'skp_kegiatan_id');
	}

	public function jangka()
	{
		return $this->belongsTo('App\Jangka', 'jangka_id');
	}

	public function output()
	{
		return $this->belongsTo('App\Satuan', 'output_id');
	}

	public function swaktu()
	{
		return $this->belongsTo('App\Satuan', 'waktu_id');
	}
	
}
