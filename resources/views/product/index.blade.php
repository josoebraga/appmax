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
                        <th>SKU</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                       @if(Auth::user()->id == 1) {{--  Tem um jeito melhor de fazer isso, através de roles, mas para este exemplo, validar por usuário já basta  --}}
                        <th>Ações</th>
                       @endif
                    </tr>
                    </thead>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->sku}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{number_format($product->price, 2, ',', '.')}}</td>
                        <td>{{$product->description}}</td>
                       @if(Auth::user()->id == 1)
                        <td>
                            <button type="button" class="btn btn-primary"><a href="{{ route('productShow', ['id'=>$product->id]) }}" style="color: white;">Editar</a></button>
                            <button type="button" onClick="excluir({{$product->id}});" class="btn btn-danger">Excluir</button>
                            <button type="button" class="btn btn-{{ $product->client_name == null ? 'warning' : 'success'}}"><a href="{{ $product->client_name == null ? route('productSendCreateManual', ['id'=>$product->id]) : '#' }}" @if($product->client_name != null) onClick="alertaBaixa();" @endif style="color: black;">@if($product->client_name == null) Dar Baixa @else {{ $product->client_name}} @endif </a></button>
                        </td>
                       @endif
                    </tr>
                    @empty

                    @endforelse
                    </table>
                </form>
                    <div class="mx-auto" style="width: 200px;">
                        {{ $products->links() }}
                        <br>
                    </div>

         </div>
    </div>
</div>

@endsection

@if(Auth::user()->id == 1)
    <script src="{{asset('js/functions.js?')}}"></script>
@endif

