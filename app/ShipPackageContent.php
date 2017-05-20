<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipPackageContent extends Model
{
    protected $table = 'ship_package_content';

    protected $fillable = [
		'id',
		'ship_info_id',
		'package_progress_code',
		'sales_info_id',
		'package_quantity',
		'staff_id',
		'memo',
    ];

	/**
	 * ShipInfo 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ship_info()
	{
		return $this->belongsTo('App\ShipInfo', 'ship_info_id', 'id');
    }

	/**
	 * SalesInfo 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function sales_info()
	{
		return $this->belongsTo('App\SalesInfo', 'sales_info_id', 'id');
    }

	/**
	 * Staff 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function staff()
	{
		return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }


}
