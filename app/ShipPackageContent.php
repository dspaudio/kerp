<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipPackageContent extends Model
{
    protected $table = 'ship_package_content';

    protected $fillable = [
		'id',
		'package_code',
		'package_progress_code',
		'sales_id',
		'package_quantity',
		'package_staff_code',
		'content_pic',
		'memo',
    ];
}
