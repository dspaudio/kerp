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
						if ($parameter['search_type'] == 'product_name') {
							$query->where('product_name', 'regexp', $parameter['keyword']);
						}
					})
					->orWhere(function($query) use($parameter) {
						if ($parameter['search_type'] == 'product_code') {
							$query->where('product_code', 'regexp', $parameter['keyword']);
						}
					})
					->orWhere(function ($query) use ($parameter) {
						if ($parameter['search_type'] == 'staff_id') {
							$query->where('staff_id', $parameter['staff_id']);
						}
					});
				}
			], [
				'supplier' => function ($query) use ($parameter) {
					$query->where(function ($query) use ($parameter) {
						if ($parameter['search_type'] == 'supplier_name') {
							$query->where('supplier_name', $parameter['keyword']);
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
			if ($parameter['search_type'] == 'order_in_made' && isset($parameter['search_date'])) {
				$query->whereDate('order_in_made', $parameter['search_date']);
			}
		})
		->orWhere(function($query) use($parameter) {
			if ($parameter['search_type'] == 'order_in_expect' && isset($parameter['search_date'])) {
				$query->whereDate('order_in_expect', $parameter['search_date']);
			}
		})
		->orWhere(function($query) use($parameter) {
			if ($parameter['search_type'] == 'order_in_received' && isset($parameter['search_date'])) {
				$query->whereDate('order_in_received', $parameter['search_date']);
			}
		})
		->orderBy($parameter['sort_field'], $parameter['orderby'])
		->paginate($parameter['limit']);

		return $order_in_info_list;
    }

}
