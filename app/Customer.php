<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
	    'id',
		'customer_name',
		'director_name',
		'director_name_jp',
		'clinic_name',
		'clinic_name_jp',
		'staff_id',
		'default_order_type_code',
		'default_payment_type_code',
		'memo',
    ];

	/**
	 * Address 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function address()
	{
		return $this->hasMany('App\Address','address_id','id');
    }

	/**
	 * Orderer 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orderer()
	{
		return $this->hasMany('App\Orderer','customer_id','id');
    }

	/**
	 * Staff 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function staff()
	{
		return $this->belongsTo('App\Staff','staff_id','id');
	}

}
