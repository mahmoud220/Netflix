<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['name','description','poster','image', 'path', 'year', 'rating', 'percent'];
}
