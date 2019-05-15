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
class InvestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $a = \Auth::user()->id;
        $invests = Invest::where('user_id', $a)->where('flag_if_sale', '=', 0)->get();
        $data=[];
        $ganancia = 0;
        $pagos=0;
        foreach($invests as $invest)
        {
            $pays = PaymentInvest::where('invest_id', $invest->id)->where('flag_if_payed', 1)->get();

            foreach ($pays as $pay)
            {
                $ganancia = $ganancia + $pay->interest_amount;
                $pagos = $pagos + $pay->capital_amount;
            }

            $article = Article::find($invest->article_id);
            $data[] =[
                    'id' => $invest->id,
                    'title' => $article->title,
                    'amount' => $invest->amount,
                    'interest' => $ganancia,
                    'pay' => $pagos
                   ];
        }
        $collection = collect($data)->paginate(5);
        return view('user.invest.index')
            ->with('collection', $collection);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::orderBy('id', 'DESC')->paginate(4);
        $articles -> each(function($articles){
            $articles->category;
            $articles->images;
        });
        $sum = 0;
        foreach ($articles as $article) {
            $sum = 0;
            $invests = Invest::where('article_id', $article->id)->get();
            foreach($invests as $invest){
                $sum = $sum + $invest->amount;
            }
            $data[] = [
                    'article_id' => $article->id,
                    'amount_collected' => $sum
                ];
        }

        return view('front.index')
            ->with('articles', $articles)
            ->with('data', $data);
    }

    public function searchCategory($name)
    {
        $category = Category::SearchCategory($name)->first();
        $articles = $category->articles()->paginate(4);

        $articles -> each(function($articles){
            $articles->category;
            $articles->images;
        });

        return view('front.index')
            ->with('articles', $articles);
    }

    public function searchTag($name)
    {
        $tag = Tag::SearchTag($name)->first();

        $articles = $tag->articles()->paginate(4);

        $articles -> each(function($articles){
            $articles->category;
            $articles->images;
        });

        return view('front.index')
            ->with('articles', $articles);
    }

    public function viewArticle($slug){
        $article = Article::where('slug', $slug)->firstOrFail();

        $article->category;
        $article->user;
        $article->tags;
        $article->images;
        return view('front.article')->with('article', $article);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invest = new Invest($request ->all());
        $invest->user_id = \Auth::user()->id;
        $invest->save();



        $article = Article::find($invest->article_id);

        $payments = Payment::where('article_id',$article->id)->get();
        $x = (($invest->amount)/($article->amount));
        foreach($payments as $payment)
        {
            $data[] =[
                    'invest_id' => $invest->id,
                    'payment_id' => $payment->id,
                    'pay' => $payment->pay * $x,
                    'balance' => $payment->balance * $x,
                    'interest_amount' => $payment->interest_amount * $x,
                    'capital_amount' => $payment->capital_amount * $x,
                   ];
        }
        PaymentInvest::insert($data);
        return redirect()->route('invests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sell(Request $request, $id)
    {
        $invest = Invest::find($id);
        return redirect()->route('invest.index');
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
        $pays = PaymentInvest::where('invest_id', $invest->id)->where('flag_if_payed', 1)->get();

        $ganancia = 0;
        $pagos = 0;

            foreach ($pays as $pay)
            {
                $ganancia = $ganancia + $pay->interest_amount;
                $pagos = $pagos + $pay->capital_amount;
            }

        $maximo = $invest->amount - $pagos;

        $article = Article::find($invest->article_id);
        return view('user.invest.edit')
            ->with('invest', $invest)
            ->with('article', $article)
            ->with('maximo', $maximo);

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
        $invest = Invest::find($id);
        $invest->fill($request->all());
        $invest->save();

        Flash::success('La inversion '. $invest->id. ' ha sido publicada para su venta con exito!');
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

    public function show($id)
    {
        $invest = Invest::find($id);
        $payments = PaymentInvest::where('invest_id', $invest->id)->orderBy('id','ASC')->paginate(5);
        return view('user.invest.show')
            ->with('payments', $payments)
            ->with('invest', $invest);
    }
    public function __construct()
    {
        $this->middleware(['auth']);
    }
}
