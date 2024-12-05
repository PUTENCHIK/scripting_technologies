<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\DirectorRequest;
use App\Models\Director;
use App\Models\Film;

class DirectorController extends Controller
{

    public function index()
    {
        $directors = Director::all();

        return view('directors.index', ['directors' => $directors]);
    }

    public function create()
    {
        $empty = new Director;
        return view('directors.create', ['empty' => $empty]);
    }


    public function store(DirectorRequest $request)
    {
        Director::create([
            'full_name' => $request['full_name'],
            'slug' => Str::slug(Str::transliterate($request['full_name']), '-')
        ]);

        return redirect()->route('directors');
    }


    public function show(string $slug)
    {
        $director = Director::where('slug', $slug)->firstOrFail();
        $films = Film::where('director_id', $director->id)->get();

        return view('directors.show', [
            'director' => $director,
            'films' => $films
        ]);
    }

    public function edit(string $slug)
    {
        $director = Director::where('slug', $slug)->firstOrFail();

        return view('directors.edit', ['director' => $director]);
    }


    public function update(DirectorRequest $request, string $slug)
    {
        Director::where('slug', $slug)->firstOrFail()
            ->update($request->all());

        return redirect()->route('directors.show', $slug);
    }

    public function delete(string $slug)
    {
        Director::where('slug', $slug)->firstOrFail()
            ->delete();

        return redirect()->route('directors');
    }
}
