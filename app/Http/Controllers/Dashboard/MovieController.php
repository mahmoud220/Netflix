<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\StreamMovie;
use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:read_movies')->only(['index']);
        $this->middleware('permission:create_movies')->only(['create', 'store']);
        $this->middleware('permission:update_movies')->only(['edit', 'update']);
        $this->middleware('permission:delete_movies')->only(['destroy']);
    }

    public function index()
    {
        $movies = Movie::paginate(5);
        return view('dashboard.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movie = Movie::create([]);
        return view('dashboard.movies.create', compact('movie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = Movie::FindOrFail($request->movie_id);
        $movie->update([
            'name'=> $request->name,
            'path' => $request->file('movie')->store('movies'),
        ]);

        $this->dispatch(new StreamMovie($movie));
        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('dashboard.movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $movie->id,
            'permissions' => 'required|array|min:1',
            ]);

            $movie->update($request->all());
            $movie->syncPermissions($request->permissions);
            session()->flash('success', 'Data updated successfully');
            return redirect()->route('dashboard.movies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        session()->flash('success', 'Data deleted successfully');
        return redirect()->route('dashboard.movies.index');
    }
}
