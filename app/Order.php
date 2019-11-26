<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tbl_order';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'order_id',
		'name',
		'phone',
		'address',
		'email',
		'message',
		'product',
		'order_status',
		'total_amount', 
	];
	public $timestamps = true;
}
