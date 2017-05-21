<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInInfo extends Model
{
    protected $table = 'order_in_info';

    protected $fillable = [
		'id',
		'sales_info_id',
		'order_in_progress_code',
		'supplier_id',
		'order_in_quantity',
		'staff_id',
		'order_in_made',
		'order_in_expect',
		'order_in_received',
		'memo',
    ];

	/**
	 * SalesInfo 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function sales_info()
	{
		return $this->belongsTo('App\SalesInfo', 'sales_info_id', 'id');
    }

	/**
	 * Supplier 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function supplier()
	{
		return $this->belongsTo('App\Supplier', 'supplier_id', 'id');
    }

	/**
	 * Staff 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function staff()
	{
		return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

	public static function order_in_info_list($parameter=[])
	{
		$order_in_info_list = self::with(
			[
				'sales_info' => function($query) use($parameter) {
					$query->where(function ($query) use ($parameter) {
						if (isset($parameter['product_search_string'])) {
							$query->where('product_code', 'regexp', $parameter['product_search_string'])
								->orWhere('product_name', 'regexp', $parameter['product_search_string'])
								->orWhere('product_type_code', 'regexp', $parameter['product_search_string'])
								->orWhere('product_type_name', 'regexp', $parameter['product_search_string']);
						}
					})
						/**
						 * 영업담당직원은 텍스트입력 아니고 드롭다운 선택으로 검색하게 한다 -> 선택한 영업직원의 id로 검색
						 */
					->where(function ($query) use ($parameter) {
						if ($parameter['staff_id'] > 0 ) {
							$query->where('staff_id', $parameter['staff_id']);
						}
					});
				}
			], [
				'supplier' => function ($query) use ($parameter) {
					$query->where(function ($query) use ($parameter) {
						if (isset($parameter['supplier_name'])) {
							$query->where('supplier_name', 'regexp', $parameter['supplier_name']);
						}
					});
				}
			],
			'staff'
		)
		/**
		 * order_in_made
		 * order_in_expect
		 * order_in_received
		 */
		->where(function($query) use($parameter) {
			if (isset($parameter['order_in_made'])) {
				$query->whereDate('order_in_made', $parameter['order_in_made']);
			}
		})
		->where(function($query) use($parameter) {
			if (isset($parameter['order_in_expect'])) {
				$query->whereDate('order_in_expect', $parameter['order_in_expect']);
			}
		})
		->where(function($query) use($parameter) {
			if (isset($parameter['order_in_received'])) {
				$query->whereDate('order_in_received', $parameter['order_in_received']);
			}
		})
		->orderBy($parameter['sort_field'], $parameter['orderby'])
		->paginate($parameter['limit']);

		return $order_in_info_list;
    }

}
