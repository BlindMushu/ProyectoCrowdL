<?php
namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentInvest extends Model
{
    use SoftDeletes;

    protected $table = "payments_invests";
    protected $fillable = ['article_id','invest_id', 'pay','flag_if_payed'];


    public function invests(){

        return $this->hasMany('App\Invest');

    }

    public function payments(){

        return $this->hasMany('App\Payment');

    }
}