<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_type';

    protected $fillable = [
		'id',
		'product_type_code',
		'product_type_name',
		'memo',
    ];

	/**
	 * Product 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function product()
	{
		return $this->hasMany('App\Product', 'product_type_id', 'id');
    }

}
