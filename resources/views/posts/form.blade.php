@extends('templates.template')

@section('content')
<h1 class="title-pg">{{$title}}</h1>
@if(isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif
<hr>
@if(isset($post))
<form class="form" method="post" action="{{route('posts.update', $post->id)}}">
    {!! method_field('PUT') !!}
@else
<form class="form" method="post" action="{{route('posts.store')}}">
@endif
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" name="title" class="form-control" value="{{$post->title or old('title')}}">
    </div>
    <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea name="description" class="form-control">{{$post->description or old('description')}}</textarea>
    </div>
    <a href="{{route('posts.index')}}" class="btn btn-default">
        <span class=" glyphicon glyphicon-backward"></span>&nbsp;Voltar para Listagem
    </a>
    <button class="btn btn-success">Salvar</button>
</form>
@endsection