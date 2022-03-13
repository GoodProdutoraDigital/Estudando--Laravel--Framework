@extends('layouts.main')

@section('title', 'HDC 2 Events')

@section('content')

    {{--Diretivas For e Foreach--}}

    @if ($nome == 'Charles')
        <p>{{ $nome  }}<p>
    @elseif ($nome != 'Charles')
        <small>Meu nome nao é {{  $nome  }}<small>
    @else
        <p>Meu nome não é {{  $nome  }}</p>    
    @endif

    @for($i = 0; 
    $i < count($array); 
    $i++)
        <p>{{  $array[$i] }}</p>
        <p>Indices: {{ $i }}</p>
        @if ($i == 2)
            <p>Imperador é = a 2</p>
        @endif
    @endfor

    @foreach ($array2 as $nomes)
        <p>Indices: {{$loop->index}}</p>
        <p>{{$nomes}}</p>
    @endforeach

    {{--Diretiva PHP--}}
    @php
        $name = 'Charles';
        echo 'Seja bem vindo: '.$name;
    @endphp

@endsection