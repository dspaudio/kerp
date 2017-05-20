<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
		'sales_quantity',
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
		return $this->hasMany('App\OrderInInfo','sales_info_id','id');
    }

	/**
	 * Customer 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer()
	{
		return $this->belongsTo('App\Customer','customer_id','id');
    }

	/**
	 * Orderer 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function orderer()
	{
		return $this->belongsTo('App\Orderer','orderer_id','id');
    }

	/**
	 * Product 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product()
	{
		return $this->belongsTo('App\Product','product_id','id');
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
