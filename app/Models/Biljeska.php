<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biljeska extends Model
{
    public $timestamps=false;

    protected $table='biljeske';

    protected $fillable=['naslov', 'sadrzaj'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
