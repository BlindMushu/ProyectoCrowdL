<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Article;
use App\Image;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ArticleRequest;
use App\Payment;
use Carbon\Carbon;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $a = \Auth::user()->id;
        $articles = Article::Search($request -> title)->where('user_id', $a)->orderBy('id','DESC')->paginate(5);
        $articles -> each(function($articles){
            $articles -> category;
            $articles -> user;
        });
        return view('admin.articles.index')
            ->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('name', 'id')->pluck('name', 'id');
        $tags = Tag::select('name', 'id')->pluck('name', 'id');

        return view('admin.articles.create')->with('categories', $categories)->with('tags', $tags);
        // return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        if ($request -> file('image'))
        {
        $file = $request->file('image');
        $name = 'proyecto_' . time() . '.' . $file->getClientOriginalExtension();

        $path = public_path() . '/images/articles/';
        $file->move($path, $name);
        }

        $article = new Article($request ->all());
        $article->user_id = \Auth::user()->id;

        if($article->years < 2)
        {
            $article->interest = 18;
        }
        if($article->years >= 2 && $article->years <= 5)
        {
            $article->interest = 11;
        }
        else
        {
            $article->interest = 6;
        }
        $article->save();


        //$payment = new Payment();
        $count = (($article->years)*12);
        $counts=[];
        for($i = 1; $i <= $count; $i++)
        {
            $counts[$i] = $i;
        }
        $monto = $article->amount;
        $meses = $count;
        $inte = $article->interest;
        $p = $inte;
        $capi = 0;
        $cargo = 0.00;
        $tot = 0.00;
        $inte = ($inte / 12) / 100;
        $cuota = $monto * (($inte * pow(1 + $inte, $meses)) / ((pow(1 + $inte, $meses)) - 1));
        $interes = 0.00;
        $cuota = round($cuota * 100) / 100;
        $s = $monto;
        $d=30;
        foreach($counts as $c)
       {
                $fecha = Carbon::now();
                $interes = ($s * 30 * $p) / 36000;
                $interes = round($interes * 100) / 100;
                $capi = $cuota - $interes;
                $capi = round($capi * 100) / 100;
                $cargo = $s * 0.0006;
                $cargo = round($cargo * 100) / 100;
                $tot = $cuota + $cargo;
                $tot = round($tot * 100) / 100;
                $s = $s - $capi;
                $s = round($s * 100) / 100;
        $data[] =[
                    'article_id' => $article->id,
                    'pay' => $cuota,
                    'balance' => max($s,0),
                    'interest_amount' => $interes,
                    'capital_amount' => $capi,
                    'payday' => $fecha->addDays($d),
                    'num_pay' => $c,
                   ];

                $d=$d+30;

       }

        Payment::insert($data);

        $article->tags()->sync($request->tags);

        $image = new Image();
        $image -> name = $name;
        $image->article()->associate($article);

        $image->save();

        Flash::success('Se ha creado el artidulo '. $article->title . ' de forma satisfactoria.');

        return redirect()->route('articles.index');
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
       $article = Article::find($id);
       $article -> category;
       $categories = Category::select('name', 'id')->pluck('name', 'id');
       $tags = Tag::select('name','id')->pluck('name','id');

       $mytags = $article->tags->pluck('id');

        return view('admin.articles.edit')
            ->with('categories', $categories)
            ->with('article', $article)
            ->with('tags', $tags)
            ->with('mytags',$mytags);
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
        $article = Article::find($id);
        $article->fill($request->all());
        $article -> save();

        $article->tags()->sync($request->tags);
        Flash::warning('Se ha editado el articulo ' . $article->title. ' de forma exitosa!');

        return redirect()->route('articles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        Flash::error('Se ha borrado el articulo '. $article->title. ' de forma exitosa');
        return redirect()->route('articles.index');
    }

    public function __construct()
    {
        $this->middleware(['auth']);
    }
}
