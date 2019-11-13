<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'tbl_reviews';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'content',
		'product_id',
		'star',
		'approve_status',
		'user_id'
	];
	public $timestamps = true;
}
