<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tambahan extends Model
{
    protected $table = 'tambahan';

    protected $fillable = ['skp_id', 'jangka_id', 'tugas'];

    public function skp()
	{
		return $this->belongsTo('App\Skp', 'skp_id');
	}

    public function jangka()
	{
		return $this->belongsTo('App\Jangka', 'jangka_id');
	}

}
