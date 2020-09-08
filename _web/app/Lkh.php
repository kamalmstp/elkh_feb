<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lkh extends Model
{
    protected $table = 'lkh';

	protected $fillable = ['user_id', 'tanggal'];

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function kegiatan()
    {
        return $this->hasMany('App\Kegiatan_lkh', 'lkh_id');
    }
}
