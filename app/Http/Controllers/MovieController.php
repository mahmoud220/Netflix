<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){

    }

    public function show(Movie $movie){
        $related_movies = Movie::where('id', '!=', $movie->id)
        ->whereHas('categories', function ($query) use ($movie) {
            return $query->whereIn('category_id', $movie->categories->pluck('id')->toArray());
        })->get();

    return view('movies.show', compact('movie', 'related_movies'));
    }

    public function increment_views(Movie $movie)
    {
        $movie->increment('views');

    }// end of increment_views
}
