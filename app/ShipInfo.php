<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipInfo extends Model
{
    protected $table = 'ship_info';

    protected $fillable = [
		'id',
		'package_code',
		'ship_type_id',
		'ship_progress_code',
		'address_id',
		'ship_staff_code',
		'ship_out_date',
		'ship_received_date',
		'ship_invoice_code',
		'memo',
    ];
}
