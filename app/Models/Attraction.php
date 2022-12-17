<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table='attractions';

    public function creator(){
        return $this->belongsTo(User::class, 'id_creator', 'id');
    }

    public function images(){
        return $this->hasMany(Image::class, 'id_attraction','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'id_attraction', 'id');
    }
}
