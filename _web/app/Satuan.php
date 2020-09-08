<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';

	protected $fillable = ['satuan', 'nama'];

	public function tgt_output()
	{
		return $this->hasMany('App\Target', 'output_id');
	}

	public function tgt_waktu()
	{
		return $this->hasMany('App\Target', 'waktu_id');
	}

}
