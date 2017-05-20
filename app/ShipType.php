<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipType extends Model
{
    protected $table = 'ship_type';

    protected $fillable = [
		'id',
		'ship_type_code',
		'ship_type_name',
		'memo',
    ];
}
