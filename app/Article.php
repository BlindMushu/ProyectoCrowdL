<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    use Sluggable;

     public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $table = "articles";
    protected $fillable = ['title','content','category_id','user_id','amount','years','interest'];

    public function category(){

    	return $this->belongsTo('App\Category');

    }

    public function user(){

    	return $this->belongsTo('App\User');

    }

    public function images(){

    	return $this->hasMany('App\Image');

    }

    public function invests(){

        return $this->hasMany('App\Invest');

    }

    public function payments(){

        return $this->hasMany('App\Payment');

    }

    public function tags(){
    	return $this->belongsToMany('App\Tag');
    }

    public function scopeSearch($query, $title){
        return $query->where('title', 'LIKE', "%$title%");
    }
}
