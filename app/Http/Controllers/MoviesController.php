<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Http\Requests\StoreMoviesRequest;
use App\Http\Requests\UpdateMoviesRequest;

use Inertia\Inertia;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movies::all();
        return Inertia::render('Movies/Index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Se usa la misma vista para crear los registros
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMoviesRequest $request)
    {
        // La entrada de datos se valida en StoreMoviesRequest para respetar 
        // el principio SOLID de Single Responsability
        $movie = new Movies($request->validated());
        $movie->save();
        return redirect('movie');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movies $movies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movies $movies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMoviesRequest $request, $id)
    {
        // La entrada de datos se valida en UpdateMoviesRequest para respetar 
        // el principio SOLID de Single Responsability
        $movie = Movies::find($id);
        $movie->fill($request->validated())->saveOrFail();
        return redirect('movie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = Movies::find($id);
        $movie->delete();
        return redirect('movie');
    }
}
