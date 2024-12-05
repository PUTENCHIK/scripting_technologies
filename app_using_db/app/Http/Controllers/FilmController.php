<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Director;
use App\Models\Film;
use App\Http\Requests\FilmRequest;

class FilmController extends Controller
{

    public function index()
    {
        $films = Film::all();

        return view('films.index', ['films' => $films]);
    }

    public function create()
    {
        $empty = new Film;
        $directors = Director::all();

        return view('films.create', [
            'directors' => $directors,
            'empty' => $empty
        ]);
    }

    public function store(FilmRequest $request)
    {
        Film::create([
            'name' => $request['name'],
            'slug' => Str::slug(Str::transliterate($request['name']), '-') . '-' . $request['year'],
            'director_id' => (int)$request['director_id'],
            'year' => $request['year'],
        ]);

        return redirect()->route('films');
    }

    public function show(string $slug)
    {
        $film = Film::where('slug', $slug)->firstOrFail();
        $director = Director::where('id', $film->director_id)->first();

        return view('films.show', [
            'film' => $film,
            'director' => $director
        ]);
    }

    public function edit(string $slug)
    {
        $film = Film::where('slug', $slug)->firstOrFail();
        $directors = Director::all();

        return view('films.edit', [
            'film' => $film,
            'directors' => $directors
        ]);
    }

    public function update(FilmRequest $request, string $slug)
    {
        Film::where('slug', $slug)->firstOrFail()
            ->update($request->all());

        return redirect()->route('films.show', $slug);
    }

    public function delete(string $slug)
    {
        Film::where('slug', $slug)->firstOrFail()
            ->delete();

        return redirect()->route('films');
    }
}
