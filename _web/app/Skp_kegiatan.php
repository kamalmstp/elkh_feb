<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skp_kegiatan extends Model
{
    protected $table = 'skp_kegiatan';

	protected $fillable = ['skp_id', 'kegiatan_id'];

	public function skp()
	{
		return $this->belongsTo('App\Skp', 'skp_id');
	}

	public function kegiatan()
	{
		return $this->belongsTo('App\Kegiatan_skp', 'kegiatan_id');
	}

	public function target()
	{
		return $this->hasMany('App\Target', 'skp_kegiatan_id');
	}


}
