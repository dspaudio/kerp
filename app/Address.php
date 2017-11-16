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
	    'tel',
	    'fax',
	    'mobile',
		'memo',
    ];

	/**
	 * Customer 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer()
	{
		return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

//	public function contact()
//	{
//		return $this->hasMany('App\Contact', 'address_id', 'id');
//    }


}
