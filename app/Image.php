<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $primaryKey = 'id';
	protected $table 	  = 'images';
	protected $fillable   = [
		'img_src','source_id','created_at','updated_at'
	];

	/**
	*
	*
	*/
	public static function getStatus($img_source){
		$data = Image::where('img_src',$img_source)->first();
		return $data;
	}
}
