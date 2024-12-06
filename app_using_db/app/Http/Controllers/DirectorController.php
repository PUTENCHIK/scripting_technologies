<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\DirectorRequest;
use App\Http\Resources\DirectorCollection;
use App\Http\Resources\DirectorResource;
use App\Models\Director;
use App\Models\Film;

class DirectorController extends Controller
{

    public function index()
    {
        $directors = Director::all();

        return view('directors.index', ['directors' => $directors]);
    }

    public function all()
    {
        return new DirectorCollection(Director::all());
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
            'slug' => Str::slug(Str::transliterate($request['full_name']), '-') .
                '-' . Str::random(6)
        ]);

        return redirect()->route('directors');
    }


    public function show(string $slug)
    {
        $director = Director::bySlug($slug)->firstOrFail();

        return view('directors.show', [
            'director' => $director,
            'films' => $director->films()->get()
        ]);
    }

    public function data(string $slug)
    {
        return new DirectorResource(Director::bySlug($slug));
    }

    public function edit(string $slug)
    {
        $director = Director::bySlug($slug)->firstOrFail();

        return view('directors.edit', ['director' => $director]);
    }


    public function update(DirectorRequest $request, string $slug)
    {
        Director::bySlug($slug)->firstOrFail()
            ->update($request->all());

        return redirect()->route('directors.show', $slug);
    }

    public function delete(string $slug)
    {
        Director::bySlug($slug)->firstOrFail()
            ->delete();

        return redirect()->route('directors');
    }
}
