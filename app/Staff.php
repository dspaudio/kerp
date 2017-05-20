<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
		'id',
		'staff_name',
		'staff_code',
		'memo',
    ];
}
