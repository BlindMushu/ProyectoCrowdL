<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Payment;
use App\PaymentInvest;
use Laracasts\Flash\Flash;

class PaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $article = Article::find($id);
        $payments = Payment::where('article_id', $article->id)->orderBy('num_pay','ASC')->paginate(5);
        //$fecha_actual = date("Y-m-d");
        $fecha_actual = "2019-07-03";
        return view('user.pay.show')
            ->with('payments', $payments)
            ->with('article', $article)
            ->with('fecha_actual', $fecha_actual);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('user.pay.edit')
            ->with('payment', $payment);
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
        $payment = Payment::find($id);
        $payment->flag_if_payed = 1;

        $paymentinvests = PaymentInvest::where('payment_id', $payment->id)->get();

        foreach ($paymentinvests as $paymentinvest)
        {
            $paymentinvest->flag_if_payed = 1;
            $paymentinvest->save();
        }

        $payment->save();

        Flash::warning('El pago de la cuota #'. $payment->id. ' ha sido completado con exito!');
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
        //
    }
}
