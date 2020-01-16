<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
	protected $primaryKey = 'id';
	protected $table 	  = 'jobs';
	protected $fillable   = [
		'queue','payload','attempts','reserved_at','created_at','available_at'
	];

}
