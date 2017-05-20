<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $fillable = [
		'id',
		'supplier_code',
		'supplier_name',
		'supplier_staff_name',
		'supplier_staff_contact',
		'memo',
    ];
}
