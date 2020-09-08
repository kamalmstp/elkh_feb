<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = ['skp_id', 'jangka_id', 'perilaku_id', 'nilai', 'kategori_id', 'status'];

    public function skp()
	{
		return $this->belongsTo('App\Skp', 'skp_id');
	}

    public function jangka()
	{
		return $this->belongsTo('App\Jangka', 'jangka_id');
	}

	public function perilaku()
	{
		return $this->belongsTo('App\Perilaku', 'perilaku_id');
	}

	public function kategori()
	{
		return $this->belongsTo('App\Kategori', 'kategori_id');
	}
}
