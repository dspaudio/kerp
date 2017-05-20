<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderer extends Model
{
    protected $table = 'orderer';

    protected $fillable = [
		'id',
		'customer_id',
		'orderer_name',
		'orderer_name_jp',
		'orderer_email',
		'memo',
    ];

	/**
	 * Customer 관계설정
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer()
	{
		return $this->belongsTo('App\Customer','customer_id','id');
    }

}
