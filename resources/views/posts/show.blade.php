@extends('templates.template')

@section('content')
<hr>
<h1 class="title-pg">Título: {{$post->title}}</h1>
<p><b>Descrição: </b>{{$post->description}}</p>

<form class="form" method="post" action="{{route('posts.destroy', $post->id)}}">
    {!! method_field('DELETE') !!}
    {!! csrf_field() !!}
    <a href="{{route('posts.index')}}" class="btn btn-default">
        <span class=" glyphicon glyphicon-backward"></span>&nbsp;Voltar para Listagem
    </a>
    <button class="btn btn-danger">Deletar</button>
</form>
@endsection