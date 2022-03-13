<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Chamando model Event no singular*/
use App\Models\Event;
use App\Models\User;
use Faker\Calculator\Ean;

class EventController extends Controller
{
    public function index(){

        $search = request('search');
        if($search){
            $events = Event::where([
                ['tittle', 'like', '%'.$search.'%']
            ])->get();
        }else{
            /* Capturar todos eventos do model com método ::all do nosso ORM Eloquent */
            $events = Event::all();
        }
        return view('welcome', ['events' => $events, 'search' => $search]);
        
    }

    public function create(){
        return view('events.create');
    }

    /* parâmetro Request*/
    public function store(Request $request){
        /* instanciando a model class */
        $event = new Event;

        $event->tittle = $request->tittle;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->itens = $request->itens;

        //Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){;
            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();
        /* Uso de flash message */
        return redirect('/') -> with('success-msg', 'Evento criando com Sucesso !');

    }

    public function show($id){
        $event = Event::findOrFail($id);
        $user = auth()->user();
        $hasUserJoined = false;

        /* Condição verificar se usuário logado é participante do evento */
        if($user){

            $userEvents = $user->eventsAsParticipant->toArray();
            foreach($userEvents as $userEvent){
                /* comparando id do usuário participante recebido via método criado em nosso model utilizando relations
                com id recebido via request */
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        /* Buscando usuário pelo id idêntico */ 
        $eventOwner = User::where('id', $event->user_id)
        ->first() /* Primeiro e único usuário que encontrar */
        ->toArray(); /* Transformar obj em array */
        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard',['events' => $events, 'eventsAsParticipant' => $eventsAsParticipant]);
    }

    public function destroy($id){
        Event::findOrFail($id)->delete();
        return redirect('/dashboard')->with('error-msg', 'Evento excluído com Sucesso');
    }

    public function edit($id){

        $user = auth()->user();

        /* Variável chama o objeto model Event permitindo uso de métodos */
        $event = Event::findOrFail($id);
        return view('events.edit', ['event' => $event]);

        /* Condição de segurança ao editar evento 
        Permitindo apenas para o dono do evento */
        if($user->id != $event->user_id){
            return redirect('/dashboard');
        }
    }

    public function update(Request $request){

        $data = $request->all();
        
        //Image upload
        if($request->hasFile('image') && $request->file('image')->isValid()){;
            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            
            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);
        return redirect('/dashboard')->with('success-msg', 'Evento Editado com Sucesso');
        
    }

    public function joinEvent($id){
        /* Capturando usuário autenticado */
        $user = auth()->user();
        /* Anexar o id ao método */
        $user->eventsAsParticipant()->attach($id);
        
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('success-msg', 'Presença confirmada no Evento '.$event->tittle);       

    }

    public function leaveEvent($id){
        $user = auth()->user();
        /* Desanexando usuário a evento*/ 
        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('error-msg', 'Você deixou o evento '.$event->tittle);
    }
}
