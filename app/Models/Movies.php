<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'publish', 'image', 'status'];

    public function turns()
    {
        return $this->belongToMany(Turns::class,'turns_movies');
    }
}
