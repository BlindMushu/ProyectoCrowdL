<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $table = "payments";
    protected $fillable = ['article_id', 'pay', 'flag_if_payed'];


    public function articles(){

        return $this->belongsToMany('App\Article');

    }

    public function invests(){

        return $this->belongsToMany('App\Invest');

    }

    public function payments(){

        return $this->hasMany('App\Payment');

    }

    public function paymentinvests(){

        return $this->belongsToMany('App\PaymentInvest');

    }

    public function scopeSearch($query, $article_id){
        return $query->where('id','=', $article_id);
        }
}
