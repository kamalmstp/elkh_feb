<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = 'pangkat';

	protected $fillable = ['pangkat', 'golongan'];

	public function user()
	{
		return $this->hasMany('App\User', 'pangkat_id');
	}
}
