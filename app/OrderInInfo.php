<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInInfo extends Model
{
    protected $table = 'order_in_info';

    protected $fillable = [
		'id',
		'sales_id',
		'order_in_progress_code',
		'supplier_code',
		'order_in_quantity',
		'made_staff_code',
		'order_in_made',
		'order_in_expect',
		'order_in_received',
		'memo',
    ];
}
