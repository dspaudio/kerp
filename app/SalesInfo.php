<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesInfo extends Model
{
    protected $table = 'sales_info';

    protected $fillable = [
		'id',
		'sales_code',
		'sales_progress_code',
		'sales_staff_code',
		'sales_made',
		'customer_id',
		'orderer_id',
		'product_code',
		'sales_quantity',
		'unit_price',
		'charged',
		'event_memo',
		'payment_date',
		'ship_out_complete_date',
		'payment_type_code',
		'order_type_code',
		'memo',
    ];
}
