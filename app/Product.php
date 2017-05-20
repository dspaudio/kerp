<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
		'id',
	    'product_type_code',
	    'manufacture_code',
	    'product_code',
	    'name',
	    'size',
	    'quantity',
	    'relate',
	    'stock',
	    'hold',
	    'last_stock_check',
    ];

}
