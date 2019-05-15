<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $table = "tags";
    protected $fillable = ['name'];

    public function articles(){

    	return $this->belongsToMany('App\Article')->withTimestamps();
    }

    public function scopeSearch($query, $name){

    	return $query->where('name', 'LIKE', "%$name%");
    }
    public function scopeSearchTag($query, $name){
    	return $query->where('name','=', $name);
        }
}
