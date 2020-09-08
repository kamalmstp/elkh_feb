<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan_lkh extends Model
{
    protected $table = 'kegiatan';

	protected $fillable = ['lkh_id', 'kegiatan', 'waktua', 'waktub', 'keterangan'];

	public function lkh()
	{
		return $this->belongsTo('App\Lkh', 'lkh_id');
	}
}
