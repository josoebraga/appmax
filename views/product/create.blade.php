@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <br>
            <div class="form-row">
                <div class="col-sm-10">
                    <div class="form-group col-md-6">
                    <button type="button" class="btn btn-primary btn-sm w-25" onClick="voltar();">Voltar</button>
                </div>
                </div>
            </div>
            <br>
            <form class="form-group" method="POST" action="{{ route('productStore')}}">
                    {{csrf_field()}}
                <br><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name" class="col-sm-6 col-form-label">Nome do Produto:</label>
                        <div class="col-sm-10">
                            <input class="form-group w-50" id="name" name="name" type="text" placeholder="Digite o Nome do Produto" required>
                        </div>
                      </div>
                    <div class="form-group col-md-6">
                        <label for="name" class="col-sm-6 col-form-label">Valor do Produto:</label>
                        <div class="col-sm-10">
                            <input class="form-group w-50" id="price" name="price" type="text" onKeyPress="return(MascaraMoeda(this, '.', ',', event))" placeholder="Digite o Valor do Produto" required>
                        </div>
                      </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description" class="col-sm-2 col-form-label">Descrição:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" name="description" style="width: 445px;" required></textarea>
                        </div>
                      </div>
                </div>

                <br><br>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

            </form>

            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{asset('js/functions.js?')}}"></script>
