@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

{{-- Params --}}

{{-- @if ($id != null)
    <p>Exibindo  id: {{$id}}</p>
@endif --}}

{{-- Query Params --}}

@if ($busca != '')
    <p>Buscando por: {{$busca}}</p>
@endif

@endsection