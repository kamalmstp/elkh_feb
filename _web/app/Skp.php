<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skp extends Model
{
    protected $table = 'skp';

	protected $fillable = ['user_id', 'tahun_id'];

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function kegiatan()
    {
        return $this->hasMany('App\Skp_kegiatan', 'skp_id');
    }

    public function tahun()
	{
		return $this->belongsTo('App\Tahun', 'tahun_id');
	}

	public function target()
    {
        return $this->hasMany('App\Target', 'skp_id');
    }
}
