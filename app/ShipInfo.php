<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipInfo extends Model
{
    protected $table = 'ship_info';

    protected $fillable = [
		'id',
		'ship_type_code',
		'ship_progress_code',
		'address_id',
		'staff_id',
		'ship_out_date',
		'ship_received_date',
	    'ship_pic',
		'ship_invoice_code',
		'memo',
    ];

	/**
	 * ShipPackageContent 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ship_package_content()
	{
		return $this->hasMany('App\ShipPackageContent', 'ship_info_id', 'id');
	}

	/**
	 * Address 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function address()
	{
		return $this->belongsTo('App\Address', 'address_id', 'id');
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
