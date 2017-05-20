<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderType extends Model
{
    protected $table = 'order_type';

    protected $fillable = [
		'id',
		'order_type_code',
		'order_type_name',
		'memo',
    ];
}
