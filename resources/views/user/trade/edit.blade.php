@extends('admin.template.main')

@section('title','Vender inversion')
<br>
<style type="text/css">

.invoice {
    position: relative;
    background-color: #FFF;

    padding: 15px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}


.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

		@media print {
		    .invoice {
		        font-size: 11px!important;
		        overflow: hidden!important
		    }

		    .invoice footer {
		        position: absolute;
		        bottom: 10px;
		        page-break-after: always
		    }

		    .invoice>div:last-child {
		        page-break-before: always
		    }


		}
.notices {
    padding-left: 6px;
    border-left: 10px solid #3989c6;
    font-size: 1.2em;
    width: 95%;
    position: relative;
    margin: auto;
}

</style>
@section('content')

<div id="invoice">
        		<div class="notices">
                    <div>Proyecto: {{$article->title}} <a href="{{route('front.view.article', $article->slug)}}" class="btn btn-primary pull-right">Visitar Proyecto</a></div>
                    <br>
                    <div class="notice">Propietario: {{$user->name}}</div>
                    <br>
				</div>

        <br>
            <div class="invoice overflow-auto">
                <div style="min-width: 450px">
                    <main>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">DESCRIPCION</th>

                                    <th class="text-right">MONTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="no">01</td>
                                    <td class="text-left"><h3>
                                        Monto invertido
                                        </h3>

                                       Este es el monto original de la inversion.
                                    </td>


                                    <td class="total">{{$invest->amount}} Bs.</td>
                                </tr>
                                <tr>
                                    <td class="no">02</td>
                                    <td class="text-left"><h3>Precio de venta</h3></td>


                                    <td class="total">{{$invest->amount_sale}} Bs.</td>
                                </tr>
                            </tbody>
                        </table>


                    </main>
                </div>
            </div>
</div>

	{!! Form::open(['route' => ['trades.update', $invest], 'method' => 'PUT'])!!}
		<div class="form-group">
			{!! Form::hidden('id', 'ID')!!}
			{!! Form::hidden('id', $invest->id, ['class' => 'form-control', 'readonly'=>'readonly'])!!}
		</div>

		<div class="form-group">
			{!! Form::hidden('title', 'Nombre del proyecto')!!}
			{!! Form::hidden('title', $article->title, ['class' => 'form-control', 'readonly'=>'readonly'])!!}
		</div>

		<div class="form-group">
			{!! Form::hidden('amount', 'Monto invertido')!!}
			{!! Form::hidden('amount', $invest->amount, ['class' => 'form-control', 'readonly'=>'readonly'])!!}
		</div>
		<div class="form-group">
		{{Form::hidden('user_id', Auth::user()->id ,['class' => 'form-control'])}}
		{{Form::hidden('article_id', $invest->article_id ,['class' => 'form-control'])}}
		{{Form::hidden('flag_if_sale', 0,['class' => 'form-control'])}}
		</div>
		<div class="form-group">
		{!! Form::hidden('amount_sale', 'Precio de venta')!!}
		{!! Form::hidden('amount_sale', $invest->amount_sale, ['class' => 'form-control', 'readonly'=>'readonly' ])!!}
		</div>
		<div class="form-group">
			@if(Auth::user()->id === $article->user_id || Auth::user()->id === $invest->user_id)
			<input class="btn btn-primary btn-lg disabled" onclick="return confirm_buy()" type="submit" value="Comprar" disabled>
			@else
			<input class="btn btn-primary " onclick="return confirm_buy()" type="submit" value="Comprar" >
			@endif
		</div>
	{!! Form::close()!!}

<script type="text/javascript">
function confirm_buy() {
  return confirm('Esta seguro que quiere comprar?');
}
</script>
@endsection