<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesProgressCode extends Model
{
    protected $table = 'sales_progress_code';

    protected $fillable = [
		'id',
		'sales_progress_code',
		'sales_progress_name',
		'memo',
    ];
}
