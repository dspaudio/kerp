<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInProgressCode extends Model
{
    protected $table = 'order_in_progress_code';

    protected $fillable = [
		'id',
		'order_in_progress_code',
		'order_in_progress_name',
		'memo',
    ];
}
