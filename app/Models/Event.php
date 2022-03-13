<?php

/* Model responsável por  conectar com a tabela events do nosso banco de dados */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    /* Uso da sintax casts
    Eloquent passa a entender que o campo itens deverá ser tratado como um array, 
    por padrão isso não é possível de se fazer diretamente no banco de dados. */
    protected $casts = [
        'itens' => 'array'
    ];

    /*Uso da sintax fillable
    Com o uso do fillable você garante que um campo de preenchimento automático não seja preenchido pelo usuário*/    
    protected $fillable = [
        'tittle', 'description', 'city', 'private', 'image', 'itens', 'date' , 'created_at' , 'updated_at'
    ];

    /* itens enviado via post poderá ser atualizar sem restrição */ 
    protected $guarded = [];

    protected $dates = ['date'];

    public function user(){
        /* Pertence a um usuário */
        /* relação one to many */
        return $this->belongsTo('App\Models\User');
    }

    public function users(){
        /* Pertence a muitos usuário */
        /* relação many to many */
        return $this->belongsToMany('App\Models\User');
    }
}
