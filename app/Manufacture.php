<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    protected $table = 'manufacture';

    protected $fillable = [
		'id',
		'manufacture_name',
		'manufacture_code',
		'memo',
    ];

	/**
	 * Product 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function product()
	{
		return $this->hasMany('App\Product', 'manufacture_id', 'id');
    }

}
