@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-tittle-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td><a href="/events/{{$event->id}}">{{$event->tittle}}</td>
                    <td>{{count($event->users)}}</td>
                    <td>
                        <a href="/events/edit/{{$event->id}}" class="btn btn-warning edit-btn"><ion-icon name="create-outline"></icon-icon></a>
                        <form action="/events/{{$event->id}}" method="post">
                            @csrf
                            {{--Declarando o metodo como DELETE--}}
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></icon-icon></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @else
    <p>Você ainda não possui algum evento criado. <a href="/events/create">criar novo evento</a></p>

    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-tittle-container">
    <h1>Minha Presença</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
@if(count($eventsAsParticipant) > 0 );
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Participantes</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($eventsAsParticipant as $event)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td><a href="/events/{{$event->id}}">{{$event->tittle}}</td>
                <td>{{count($event->users)}}</td>
                <td>
                    <form action="/events/leave/{{$event->id}}" method="post">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-warning leave-btn">Deixar Evento</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@else
<p>Você ainda não confirmou presença em nenhum dos eventos, <a href="/">ver eventos</a></p>

@endif
</div>

@endsection