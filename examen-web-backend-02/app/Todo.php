<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model {

	/**
	 * The database table used by the model.
	 * 
	 * @var string
	 */
	protected $table = 'todos';

	/**
	 * Set if you want to use softDelete or not.
	 * 
	 * @var boolean
	 */
	use SoftDeletes;

	protected $dates = ['deleted_at'];

	/**
	 * Here we say what fields in the table can be filled.
	 * 
	 * @var [type]
	 */
	protected $fillable = [
		'item',
		'done'
	];

}
