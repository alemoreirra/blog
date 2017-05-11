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
@if(isset($costumer))
{!! Form::model(
$costumer,
array(
'route' => array('costumers.update', $costumer->id), 
'class' => 'form', 
'files' => true,
'method' => 'put')
) !!}
@else
{!! Form::open(
array(
'route' => 'costumers.store', 
'class' => 'form',

'files' => true)
) !!}
@endif
<div class="form-group">    
    @if(isset($costumer))
    <img id="img_preview" class="img-responsive" alt="Foto do cliente" style="width: 100px; height: 100px;" data-saved="{{ asset($imagePath) }}" src="{{ asset($imagePath) }}" data-holder-rendered="true">
    <div id="div_upload_image" style="{{isset($costumer) ? 'display: none;' : ''}}" class="form-group">        
        {!! Form::label('image', 'Foto') !!}
        {!! Form::file('image', '', array('class' => 'form-control')) !!}
    </div>
    <br>
    {!! Form::button('Alterar foto', array('id' => 'btn_update_image', 'class' => 'btn')) !!}
    @endif
    {!! Form::button('Cancelar alteração de imagem', array('id' => 'btn_cancel_update_image', 'class' => 'btn', 'style' => 'display:none')) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Nome') !!}
    {!! Form::text('name', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('last_name', 'Sobrenome') !!}
    {!! Form::text('last_name', null, array('class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'e-mail') !!}
    {!! Form::email('email', null, array('class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('active', 'Ativo') !!}
    @if(isset($costumer->active))
    {!! Form::checkbox('active', $costumer->active, array('class' => 'checkbox-inline')) !!}
    @else
    {!! Form::checkbox('active', null, array('class' => 'checkbox-inline')) !!}
    @endif
</div>
<div class="form-group">
    <a href="{{route('costumers.index')}}" class="btn btn-default">
        <span class=" glyphicon glyphicon-backward"></span>&nbsp;Voltar para Listagem
    </a>
    {!! Form::submit('Salvar', array('class' => 'btn btn primary btn-success')) !!}
</div>
{!! Form::close() !!}
@endsection
<script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{url('js/costumers.js')}}"></script>