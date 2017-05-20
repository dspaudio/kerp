<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 제품 모델
 * Class Product
 * @package App
 */
class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
		'id',
	    'product_type_id',
	    'manufacture_id',
	    'product_code',
	    'name',
	    'size',
	    'quantity',
	    'relate',
	    'stock',
	    'hold',
	    'last_stock_check',
    ];

	/**
	 * ProductType 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product_type()
	{
		return $this->belongsTo('App\ProductType', 'product_type_id');
    }

	/**
	 * Manufacture 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function manufacture()
	{
		return $this->belongsTo('App\Manufacture', 'manufacture_id');
    }
}
