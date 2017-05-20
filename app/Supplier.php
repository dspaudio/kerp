<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $fillable = [
		'id',
		'supplier_name',
		'supplier_staff_name',
		'supplier_staff_contact',
		'memo',
    ];

	/**
	 * OrderInInfo 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function order_in_info()
	{
		return $this->hasMany('App\OrderInInfo', 'supplier_id', 'id');
    }

}
