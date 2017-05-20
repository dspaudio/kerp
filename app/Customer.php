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


	/**
	 * 고객 리스트
	 * @param array $parameter
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public static function customer_list($parameter=[])
	{
		$customer = self::with(
			[
				'orderer' => function($query) use($parameter){
					$query->where(function($query) use($parameter){
						if ($parameter['search_type'] == 'orderer_name') {
							$query->where('orderer_name', 'regexp', $parameter['keyword']);
						}
					})
					->orWhere(function($query) use($parameter){
						if ($parameter['search_type'] == 'orderer_name_jp') {
							$query->where('orderer_name_jp', 'regexp', $parameter['keyword']);
						}
					})
					->orWhere(function($query) use($parameter){
						if ($parameter['search_type'] == 'orderer_email') {
							$query->where('orderer_email', 'regexp', $parameter['keyword']);
						}
					});
				}
			],
			[
				'address' => function($query) use($parameter){
					$query->with('contact')->where(function($query) use($parameter){
						if ($parameter['search_type'] == 'addressee') {
							$query->where('addressee','regexp', $parameter['keyword']);
						}
					})
					->orWhere(function ($query) use ($parameter) {
						if ($parameter['search_type'] == 'addressee_jp') {
							$query->where('addressee_jp', 'regexp', $parameter['keyword']);
						}
					})
					->orWhere(function ($query) use ($parameter) {
						if ($parameter['search_type'] == 'address') {
							$query->where('address', 'regexp', $parameter['keyword']);
						}
					})
					->orWhere(function ($query) use ($parameter) {
						if ($parameter['search_type'] == 'address_jp') {
							$query->where('address_jp', 'regexp', $parameter['keyword']);
						}
					})
					->orWhere(function ($query) use ($parameter) {
						if ($parameter['search_type'] == 'zip_code') {
							$query->where('zip_code', 'regexp', $parameter['keyword']);
						}
					});
				}
			]
		)
		->where(function($query) use($parameter) {
			if ($parameter['search_type'] == 'customer_name') {
				$query->where('customer_name', 'regexp' ,$parameter['keyword']);
			}
		})
		->orWhere(function($query) use($parameter) {
			if ($parameter['search_type'] == 'director_name') {
				$query->where('director_name', 'regexp' ,$parameter['keyword']);
			}
		})
		->orWhere(function($query) use($parameter) {
			if ($parameter['search_type'] == 'director_name_jp') {
				$query->where('director_name_jp', 'regexp' ,$parameter['keyword']);
			}
		})
		->orWhere(function($query) use($parameter) {
			if ($parameter['search_type'] == 'clinic_name') {
				$query->where('clinic_name', 'regexp' ,$parameter['keyword']);
			}
		})
		->orWhere(function($query) use($parameter) {
			if ($parameter['search_type'] == 'clinic_name_jp') {
				$query->where('clinic_name_jp', 'regexp' ,$parameter['keyword']);
			}
		})
		->orWhere(function ($query) use ($parameter) {
			if ($parameter['search_type'] == 'default_payment_type_code') {
				$query->where('default_payment_type_code', $parameter['default_payment_type_code']);
			}
		})
		->orderBy($parameter['sort_field'], $parameter['orderby'])
		->paginate($parameter['limit']);
		return $customer;
	}

}
