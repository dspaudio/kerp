<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderer extends Model
{
    protected $table = 'orderer';

    protected $fillable = [
		'id',
		'customer_id',
		'orderer_name',
		'orderer_name_jp',
		'orderer_email',
		'memo',
    ];
}
