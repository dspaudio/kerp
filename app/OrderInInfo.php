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
		return $this->belongsTo('App\SalesInfo','sales_info_id','id');
    }

	/**
	 * Supplier 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function supplier()
	{
		return $this->belongsTo('App\Supplier','supplier_id','id');
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
