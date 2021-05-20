<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'ingredientes', 'preparacion','imagen', 'categoria_id'];

    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
