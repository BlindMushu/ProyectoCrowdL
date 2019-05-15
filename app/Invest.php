<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invest extends Model
{
    use SoftDeletes;

    protected $table = "invests";
    protected $fillable = ['user_id', 'article_id', 'amount', 'amount_sale', 'flag_if_sale'];

    public function users(){

        return $this->belongsToMany('App\User');

    }

    public function articles(){

        return $this->belongsToMany('App\Article');

    }
    public function paymentinvests(){

        return $this->belongsToMany('App\PaymentInvest');

    }

    public function payments(){

        return $this->hasMany('App\Payment');

    }
}
