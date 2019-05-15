<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;
    protected $table = "categories";
    protected $fillable = ['name'];

    public function articles()
    {
    	return $this->hasMany('App\Article');
    }

    public function scopeSearchCategory($query, $name){
    	return $query->where('name','=',$name);
        }
}
