@extends('templates.template')

@section('content')

<h1 class="title-pg">{{$title}}</h1>
<div>
    {!! Form::open(
    array(
    'class' => 'form',
    'method' => 'GET')
    ) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
                {!! Form::label('name', 'Nome') !!}
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
                {!! Form::label('last_name', 'Sobrenome') !!}
                {!! Form::text('last_name', null, array('class' => 'form-control')) !!}
            </div>
        </div>   

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
                {!! Form::label('email', 'e-mail') !!}
                {!! Form::text('email', null, array('class' => 'form-control')) !!}
            </div>
        </div>   

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
                {!! Form::label('active', 'Ativo') !!}
                {!! Form::select('active', array('' => 'Todos', '0' => 'Não', '1' => 'Sim'), null, array('class' => 'form-control')) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="form-group">
                {!! Form::submit('Pesquisar', array('class' => 'btn btn-primary')) !!}
                <a href="{{route('costumers.index')}}" class="btn btn-default">
                    Limpar Pesquisa
                </a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<hr>
<a href="{{route('costumers.create')}}" class="btn btn-primary">
    <span class=" glyphicon glyphicon-plus"></span>Cadastrar
</a>
<hr>
<table class="table table-striped">
    <tr>
        <th>Nome</th>
        <th>Sobrenome</th>
        <th>E-mail</th>
        <th width='80px'>Ativo</th>
        <th width='80px'>Foto</th>
        <th width='80px'>Ações</th>
    </tr>
    @foreach($costumers as $costumer)
    <tr>
        <td>{{$costumer->name}}</td> 
        <td>{{$costumer->last_name}}</td> 
        <td>{{$costumer->email}}</td>
        @if($costumer->active == 1)
        <td><span class="alert-success">SIM</span></td>
        @else
        <td><span class="alert-danger">NÃO</span></td>
        @endif
        <td>
            <img id="img_preview" class="img-responsive" alt="Foto do cliente {{$costumer->name}}" style="width: 30px; height: 30px;" src="{{ asset($imagePath)}}/{{!empty($costumer->image) ? $costumer->image : 'default.png'}}">
        </td>        
        <td>
            <a href="{{route('costumers.edit', $costumer->id)}}" class="actions edit">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="{{route('costumers.show', $costumer->id)}}" class="actions delete">
                <span class="glyphicon glyphicon-eye-open"></span>
            </a>
        </td>
    </tr>        
    @endforeach
</table>
{!! $costumers->links() !!}
@endsection