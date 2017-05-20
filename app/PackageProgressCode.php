<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageProgressCode extends Model
{
    protected $table = 'package_progress_code';

    protected $fillable = [
		'id',
		'package_progress_code',
		'package_progress_name',
		'memo',
    ];
}
