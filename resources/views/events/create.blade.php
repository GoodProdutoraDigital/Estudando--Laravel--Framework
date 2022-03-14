@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-4 offset-md-4">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="post" enctype="multipart/form-data">
        {{--Diretiva de proteção csrf--}}
        @csrf
        <div class="form-group">
            <label for="image">Imagen do evento:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="tittle">Evento:</label>
            <input type="text" class="form-control" id="tittle" name="tittle" placeholder="Nome do Evento" required>
        </div>
        <div class="form-group">
            <label for="date">Data do Evento:</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Data do Evento" required>
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Cidade local do evento" required>
        </div>
        <div class="form-group">
            <label for="private">O evento é privado ?</label required>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Fale mais sobre o evento"></textarea>
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
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

@endsection