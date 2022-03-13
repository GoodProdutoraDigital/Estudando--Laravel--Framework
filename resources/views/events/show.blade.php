@extends('layouts.main')

@section('title', $event->tittle)

@section('content')

<div class="col-md10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/events/{{$event->image}}" class="img-fluid" alt="{{$event->tittle}}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{$event->tittle}}</h1>
            <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{$event->city}}</p>
            <p class="events-participantes"><ion-icon name="people-outline"></ion-icon>{{count($event->users)}}</p>
            <p class="event-owner"><ion-icon name="star-outline"></ion-icon> Organizador {{$eventOwner['name']}}</p>
            @if(!$hasUserJoined)
                <form action="/events/join/{{$event->id}}" method="post">
                    @csrf
                    <a href="/events/join/{{$event->id}}"
                    class="btn btn-primary"
                    id="event-submit"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    Confirmar Presença</a>
                </form>
            @else
                <button type="submit" class="btn btn-primary confirmado" disabled>Presença Confirmada</button>
            @endif
            <h3>O evento contará com: </h3>
            <ul id="itens-list">
                @foreach($event->itens as $item)
                    <li><ion-icon name="play-outline"></ion-icon>{{$item}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-12" id="description-container">
            <h3>Sobre o evento:</h3>
            <p class="event-description">{{$event->description}}</p>
        </div>
    </div>
</div>

@endsection