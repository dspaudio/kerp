<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

    protected $fillable = [
		'id',
		'address_id',
		'contact_type',
		'contact_num',
		'memo',
    ];
}
