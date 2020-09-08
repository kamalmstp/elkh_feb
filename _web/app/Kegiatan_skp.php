<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan_skp extends Model
{
    protected $table = 'kegiatan_skp';

	protected $fillable = ['user_id', 'kegiatan'];

	public function target()
	{
		return $this->hasMany('App\Target', 'kegiatan_id');
	}

	public function skp_kegiatan()
	{
		return $this->hasMany('App\skp_kegiatan', 'kegiatan_id');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
