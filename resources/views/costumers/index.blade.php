@extends('templates.template')

@section('content')

<h1 class="title-pg">{{$title}}</h1>
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
        <td>{{$costumer->photo}}</td>
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