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

	/**
	 * Address 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function address()
	{
		return $this->belongsTo('App\Address', 'address_id', 'id');
    }

}
