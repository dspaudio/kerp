<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
		'id',
		'customer_id',
		'addressee',
		'addressee_jp',
		'address',
		'address_jp',
		'zip_code',
		'memo',
    ];
}
