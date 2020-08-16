@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="w-2000 justify-content-center">
             <div class="bg-white">
             <br>
                <button type="button" class="btn btn-info"><a href="/product/create" style="color: white;">+ Adicionar Produto</a></button>
                <br><br>
                <form class="form-group">
                    {{csrf_field()}}

                    <table id="produtos" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Adicionado via</th>
                        <th>Baixado via</th>
                    </tr>
                    </thead>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->statusAdicionar}}</td>
                        <td>{{$product->statusBaixa}}</td>
                    </tr>
                    @empty

                    @endforelse
                    </table>
                </form>

         </div>
    </div>
</div>

<br>
@if($i < 100)
<div class="alert alert-danger" role="alert">
    Atenção! Existem menos de <b>100</b> itens no estoque!
</div>
@endif
<br>

@endsection

    <script src="{{asset('js/functions.js?')}}"></script>

