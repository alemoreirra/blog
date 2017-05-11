@extends('templates.template')

@section('content')

<h1 class="title-pg">{{$title}}</h1>
<a href="{{route('posts.create')}}" class="btn btn-primary">
    <span class=" glyphicon glyphicon-plus"></span>Cadastrar
</a>
<hr>
<table class="table table-striped">
    <tr>
        <th>Título</th>
        <th>Descrição</th>
        <th>Ações</th>
    </tr>
    @foreach($posts as $post)
    <tr>
        <td>{{$post->title}}</td> 
        <td>{{$post->description}}</td>
        <td>
            <a href="{{route('posts.edit', $post->id)}}" class="actions edit">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="{{route('posts.show', $post->id)}}" class="actions delete">
                <span class="glyphicon glyphicon-eye-open"></span>
            </a>
        </td>
    </tr>        
    @endforeach
</table>
{!! $posts->links() !!}
@endsection