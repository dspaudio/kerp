<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    protected $table = 'manufacture';

    protected $fillable = [
		'id',
		'manufacture_name',
		'manufacture_code',
		'memo',
    ];
}
