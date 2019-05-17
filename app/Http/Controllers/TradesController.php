<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Carbon\Carbon;
use App\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Invest;
use App\Payment;
use App\PaymentInvest;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Category;
class TradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invests = Invest::where('flag_if_sale', '=', 1)->get();
        $data=[];
        $article;
        foreach($invests as $invest)
        {
            $article = Article::find($invest->article_id);
            $data[] =[
                    'id' => $invest->id,
                    'title' => $article->title,
                    'amount' => $invest->amount,
                   ];
        }
        
        $collection = collect($data)->paginate(5);
        return view('user.trade.index')
            ->with('collection', $collection);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invest = Invest::find($id);
        $article = Article::find($invest->article_id);

        return view('user.trade.edit')
            ->with('invest', $invest)
            ->with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $a = \Auth::user()->id;
        $invest = Invest::find($id);
        $invest->fill($request->all());
        $invest->user_id=$a;
        $invest->amount_sale=null;
        $invest->save();

        Flash::warning('La inversion '. $invest->id. ' ha sido comprada con exito!');
        return redirect()->route('invests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
