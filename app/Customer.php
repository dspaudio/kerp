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
						if (isset($parameter['customer_search_string'])) {
							$query->where('orderer_name', 'regexp', $parameter['customer_search_string'])
								->orWhere('orderer_name_jp', 'regexp', $parameter['customer_search_string'])
								->orWhere('orderer_email', 'regexp', $parameter['customer_search_string']);
						}
					});
				}
			],
			[
				'address' => function($query) use($parameter){
					$query->with('contact')
					->where(function($query) use($parameter){
						if ($parameter['search_type'] == 'addressee_search_string') {
							$query->where('addressee','regexp', $parameter['keyword'])
								->orWhere('addressee_jp', 'regexp', $parameter['keyword']);
						}
					})

					->where(function ($query) use ($parameter) {
						if (isset($parameter['address_search_string'])) {
							$query->where('address', 'regexp', $parameter['address_search_string'])
								->orWhere('address_jp', 'regexp', $parameter['address_search_string']);
						}
					})
					->where(function ($query) use ($parameter) {
						if (isset($parameter['zip_code'])) {
							$query->where('zip_code', 'regexp', $parameter['keyword']);
						}
					});
				}
			]
		)
		->where(function($query) use($parameter) {
			if (isset($parameter['customer_search_string'])) {
				$query->where('customer_name', 'regexp' ,$parameter['customer_search_string'])
					->orWhere('director_name', 'regexp', $parameter['customer_search_string'])
					->orWhere('clinic_name', 'regexp', $parameter['customer_search_string'])
					->orWhere('director_name_jp', 'regexp', $parameter['customer_search_string'])
					->orWhere('clinic_name_jp', 'regexp', $parameter['customer_search_string']);
			}
		})
		->where(function ($query) use ($parameter) {
			if (isset($parameter['default_payment_type_code']) && $parameter['default_payment_type_code'] > 0 ) {
				$query->where('default_payment_type_code', $parameter['default_payment_type_code']);
			}
		})
//		->orderBy($parameter['sort_field'], $parameter['orderby'])
		->paginate(20);
//		->paginate($parameter['limit']);
//		default_order_type_code
//		default_payment_type_code
		$return['customer'] = $customer;
		$return['default_order_type_code'] = [
			0 => '',
			1 => '네이버',
			2 => '라인',
			3 => '야후',
			4 => '전화',
			5 => '페이스북',
			6 => '현장판매',
			7 => '홈피',
		];
		$return['default_payment_type_code'] = [
			0 => '',
			1 => '계좌입금',
			2 => '월말청구',
			3 => '해외송금',
			4 => '크레딧',
			5 => '현장판매',
			6 => '홈피결제',
		];

		return $return;
	}

}
