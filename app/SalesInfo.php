<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function notNullValue;

class SalesInfo extends Model
{
    protected $table = 'sales_info';

    protected $fillable = [
		'id',
		'sales_progress_code',
		'staff_id',
		'sales_made',
		'customer_id',
		'orderer_id',
		'product_id',
		'product_code',
		'product_name',
		'product_size',
		'product_quantity',
		'product_relate',
	    'product_type_id',
	    'product_type_code',
	    'product_type_name',
	    'manufacture_id',
	    'manufacture_name',
	    'manufacture_code',
		'sales_quantity',
	    'shipped_quantity',
	    'pended_quantity',
	    'is_order_in',
		'unit_price',
		'charged',
		'event_memo',
		'payment_date',
		'ship_out_complete_date',
		'payment_type_code',
		'order_type_code',
		'sales_cancel_date',
		'memo',
    ];

	/**
	 * OrderInInfo 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function order_in_info()
	{
		return $this->hasMany('App\OrderInInfo', 'sales_info_id', 'id');
    }

	/**
	 * ShipPackageContent 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ship_package_content()
	{
		return $this->hasMany('App\ShipPackageContent', 'sales_info_id', 'id');
	}

	/**
	 * Customer 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer()
	{
		return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }

	/**
	 * Orderer 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function orderer()
	{
		return $this->belongsTo('App\Orderer', 'orderer_id', 'id');
    }

	/**
	 * Product 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo('App\Product', 'product_id', 'id');
    }

	/**
	 * Staff 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function staff()
	{
		return $this->belongsTo('App\Staff', 'staff_id', 'id');
	}

	/**
	 * 매출 리스트
	 * @param array $parameter
	 * order_in_info - supplier_name(포함검색),order_in_progress_code(일치검색),order_in_made(날짜검색),order_in_received(날짜검색)
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public static function sales_info_list($parameter = [])
	{
		$sales_info_list = self::with(
			[
				'order_in_info' => function ($query) use ($parameter) {
					$query->where(function ($query) use ($parameter) {
						if (isset($parameter['supplier_name'])) {
							$query->where('supplier_name', 'regexp', $parameter['supplier_name']);
						}
					})
						->where(function ($query) use ($parameter) {
							if ($parameter['order_in_progress_code'] > 0) {
								$query->where('order_in_progress_code', $parameter['order_in_progress_code']);
							}
						})
						->where(function ($query) use ($parameter) {
							if (isset($parameter['order_in_made'])) {
								$query->whereDate('order_in_made', $parameter['order_in_made']);
							}
						})
						->where(function ($query) use ($parameter) {
							if (isset($parameter['order_in_received'])) {
								$query->whereDate('order_in_received', $parameter['order_in_received']);
							}
						});
				}
		//	],[
				//ship_package_content

			],[
				'customer' => function ($query) use ($parameter) {
					$query->where(function ($query) use ($parameter) {
						if (isset($parameter['customer_search_string'])) {
							$query->where('customer_name', 'regexp', $parameter['customer_search_string'])
								->orWhere('director_name', 'regexp', $parameter['customer_search_string'])
								->orWhere('clinic_name', 'regexp', $parameter['customer_search_string'])
								->orWhere('director_name_jp', 'regexp', $parameter['customer_search_string'])
								->orWhere('clinic_name_jp', 'regexp', $parameter['customer_search_string']);
						}
					});
				}
			],
			[
				'orderer' => function ($query) use ($parameter) {
					$query->where(function ($query) use ($parameter) {
						if (isset($parameter['customer_search_string'])) {
							$query->where('orderer_name', 'regexp', $parameter['customer_search_string'])
								->orWhere('orderer_name_jp', 'regexp', $parameter['customer_search_string'])
								->orWhere('orderer_email', 'regexp', $parameter['customer_search_string']);
						}
					});
				}
			], 'staff'
		)
			/**
			 * 영업담당직원은 텍스트입력 아니고 드롭다운 선택으로 검색하게 한다 -> 선택한 영업직원의 id로 검색
			 */
			->where(function ($query) use ($parameter) {
				if (isset($parameter['staff_id']) && $parameter['staff_id'] > 0) {
					$query->where('staff_id', $parameter['staff_id']);
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['search_type']) && $parameter['search_type'] > 0 ) {
					$query->where('sales_progress_code', $parameter['sales_progress_code']);
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['sales_made'])) {
					$query->whereDate('sales_made', $parameter['sales_made']);
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['product_search_string'])) {
					$query->where('product_code', 'regexp', $parameter['product_search_string'])
						->orWhere('product_name', 'regexp', $parameter['product_search_string'])
						->orWhere('product_type_code', 'regexp', $parameter['product_search_string'])
						->orWhere('product_type_name', 'regexp', $parameter['product_search_string']);
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['manufacture_search_string'])) {
					$query->where('manufacture_name', 'regexp', $parameter['manufacture_search_string'])
						->orWhere('manufacture_code', 'regexp', $parameter['manufacture_search_string']);
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['payment_date'])) {
					$query->whereDate('payment_date', $parameter['payment_date']);
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['ship_out_complete_date'])) {
					$query->whereDate('ship_out_complete_date', $parameter['ship_out_complete_date']);
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['payment_type_code']) && $parameter['payment_type_code'] > 0) {
					$query->where('payment_type_code', $parameter['payment_type_code']);
				}
			})
			/**
			 * 화면에서 체크박스 같은거 만들어서
			 * 이벤트 매출 보기 체크하면 - event_memo 가 null 이 아닌 경우만 가져옴
			 * 미결제건 보기 체크하면 - payment_date 가 null 인 경우만 가져옴
			 * 발송미완건 보기 체크하면 -  ship_out_complete_date 가 null 인 경우만 가져옴
			 */
			->where(function ($query) use ($parameter) {
				if (isset($parameter['search_type']) && $parameter['search_type'] == 'event_flag') {
					$query->whereNotNull('event_memo');
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['search_type']) && $parameter['search_type'] == 'unpaid_flag') {
					$query->whereNull('payment_date');
				}
			})
			->where(function ($query) use ($parameter) {
				if (isset($parameter['search_type']) && $parameter['search_type'] == 'ship_out_uncompleted_flag') {
					$query->whereNull('ship_out_complete_date');
				}
			})
			->orderBy($parameter['sort_field'], $parameter['orderby'])
//			->toSql();
			->paginate($parameter['limit']);
		return $sales_info_list;
	}
}
