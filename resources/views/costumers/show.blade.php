@extends('templates.template')

@section('content')
<hr>
<img id="img_preview" class="img-responsive" alt="Foto do cliente" style="width: 100px; height: 100px;" src="{{ asset($imagePath) }}" data-holder-rendered="true">
<h1 class="title-pg">Nome: {{$costumer->name}}</h1>
<p><b>Sobrenome: </b>{{$costumer->last_name}}</p>
<p><b>e-mail: </b>{{$costumer->email}}</p>
<p><b>Ativo: </b>{{($costumer->active) ? 'Sim' : 'Não'}}</p>

<form class="form" method="post" action="{{route('costumers.destroy', $costumer->id)}}">
    {!! method_field('DELETE') !!}
    {!! csrf_field() !!}
    <a href="{{route('costumers.index')}}" class="btn btn-default">
        <span class=" glyphicon glyphicon-backward"></span>&nbsp;Voltar para Listagem
    </a>
    <button class="btn btn-danger">Deletar</button>
</form>
@endsection