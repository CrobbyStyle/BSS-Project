<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vector extends Model{
	protected $table = 'vector';

	public function Lugar(){
		return $this->hasOne('App\Lugar', 'lugar_id', 'lugar_id');
	}
}