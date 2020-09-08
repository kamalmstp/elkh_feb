<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'atasan_id','pangkat_id','bagian_id', 'name', 'email', 'password', 'nip', 'jabatan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bawahan()
    {
        return $this->hasMany('App\User', 'atasan_id');
    }

    public function kegiatan()
    {
        return $this->hasMany('App\Kegiatan_skp', 'user_id');
    }

    public function atasan()
    {
        return $this->belongsTo('App\User', 'atasan_id');
    }

    public function pangkat()
    {
        return $this->belongsTo('App\Pangkat', 'pangkat_id');
    }

     public function bagian()
    {
        return $this->belongsTo('App\Bagian', 'bagian_id');
    }
}
