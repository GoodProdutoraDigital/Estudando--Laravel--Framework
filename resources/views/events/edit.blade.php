@extends('layouts.main')

@section('title', 'Editar: '.$event->tittle)

@section('content')

<div id="event-create-container" class="col-md-4 offset-md-4">
    <h1>Editando: {{$event->tittle}}</h1>
    <form action="/events/update/{{$event->id}}" method="post" enctype="multipart/form-data">
        {{--Diretiva de proteção csrf--}}
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Imagen do evento:</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <img src="/img/events/{{$event->image}}" alt="{{$event->tittle}}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="tittle">Evento:</label>
            <input type="text" class="form-control" id="tittle" name="tittle" value="{{$event->tittle}}">
        </div>
        <div class="form-group">
            <label for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{$event->date->format('Y-m-d')}}">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" value="{{$event->city}}">
        </div>
        <div class="form-group">
            <label for="private">O evento é privado ?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                {{--if ternario para verificar evento privado
                atributo selected recebe selected se não vazio--}}
                <option value="1" {{$event->private == 1 ? "selected='selected'" : ""}}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="tittle">Adicione itens de infrainstrutura:</label>
            <div class="form-group">
                {{--Array de itens--}}
                <input type="checkbox" name="itens[]" value="Cadeiras"> Cadeiras
            </div>
            <div class="form-group">
                {{--Array de itens--}}
                <input type="checkbox" name="itens[]" value="Palcos"> Palcos
            </div>
            <div class="form-group">
                {{--Array de itens--}}
                <input type="checkbox" name="itens[]" value="Comidas"> Open Food
            </div>
            <div class="form-group">
                {{--Array de itens--}}
                <input type="checkbox" name="itens[]" value="Bebidas"> Open Bar
            </div>
            <div class="form-group">
                {{--Array de itens--}}
                <input type="checkbox" name="itens[]" value="Shows"> Show's
            </div>
            <div class="form-group">
                {{--Array de itens--}}
                <input type="checkbox" name="itens[]" value="Brindes"> Brindes
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Editar Evento">
    </form>
</div>

@endsection