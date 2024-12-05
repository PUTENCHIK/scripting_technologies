<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Director;
use App\Models\Film;
use App\Http\Requests\FilmRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::all();
        // $films->load('directors');

        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $film = new Film;
        $directors = Director::pluck('full_name', 'id');

        return view('films.create', ['directors' => $directors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'director_id' => 'required',
            'year' => 'required'
        ]);
        Film::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name'], '-'),
            'director_id' => $request['director_id'],
            'year' => $request['year'],
        ]);

        return redirect()->route('films.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = Film::findOrFail($id);

        return view('films.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $film = new Film;
        return view('films.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $film = Film::findOrFail($id);
        $film->update($request->all());

        return redirect()->route('films.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return redirect()->route('films.index');
    }
}
