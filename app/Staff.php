<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
		'id',
		'staff_name',
		'memo',
    ];

	/**
	 * ShipInfo 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ship_info()
	{
		return $this->hasMany('App\ShipInfo', 'staff_id', 'id');
    }

	/**
	 * ShipPackageContent 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ship_package_content()
	{
		return $this->hasMany('App\ShipPackageContent', 'staff_id', 'id');
    }

	/**
	 * OrderInInfo 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function order_in_info()
	{
		return $this->hasMany('App\OrderInInfo', 'staff_id', 'id');
    }


}
