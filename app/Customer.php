<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
	    'id',
		'customer_name',
		'director_name',
		'director_name_jp',
		'clinic_name',
		'clinic_name_jp',
		'default_staff_code',
		'default_order_type_code',
		'default_payment_type_code',
		'memo',
    ];
}
