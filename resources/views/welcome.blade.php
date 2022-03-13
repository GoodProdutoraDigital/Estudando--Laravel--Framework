@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="/" method="get">
        <input type="text" id="search" name="search" class="form-control" placeholder="Pressione enter para pesquisar um evento">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{$search}} </h2>
    @else
    <h2>Próximo Eventos</h2>
    @endif    
    <p class="subtitle">Veja eventos dos próximos dias </p>
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            {{-- alt atributo de acessibilidade --}}
            <img src="/img/events/{{$event->image}}" alt="{{$event->tittle}}">
            <div class="card-body">
                {{--formatando data utilizando a função date--}}
                <p class="card-date">{{ date('d/m/Y', strtotime($event->date))}}</p>
                <h5 class="card-tittle">{{$event->tittle}}</h5>
                <p class="card-participantes">{{count($event->users)}} Participantes</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary">Saiba Mais</a>
            </div>
        </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p class="events-message">Não foi possível encontrar nenhum evento com {{$search}} ! <a href="/">Ver todos</p>
        @elseif(count($events) == 0)
            <p class="events-message">Não há eventos disponiveis</p>
        @endif
    </div>
</div>

@endsection