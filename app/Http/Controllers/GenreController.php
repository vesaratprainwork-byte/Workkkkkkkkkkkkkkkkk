<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GenreController extends Controller
{
    public function list()
    {
        Gate::authorize('viewAny', Genre::class);
        $genres = Genre::paginate(10);
        return view('genres.list', [
            'genres' => $genres,
        ]);
    }

    public function createForm()
    {
        Gate::authorize('create', Genre::class);
        return view('genres.create-form');
    }

    public function create(Request $request)
    {
        Gate::authorize('create', Genre::class);
        $request->validate([
            'code' => 'required|string|max:10|unique:genres,code',
            'name' => 'required|string|max:255',
        ]);

        $genre = new Genre();
        $genre->code = $request->code;
        $genre->name = $request->name;
        $genre->description = $request->description;
        $genre->save();

        return redirect()->route('genres.list')->with('status', "Genre '{$genre->name}' was created successfully.");
    }

    public function updateForm(Genre $genre)
    {
        Gate::authorize('update', $genre);
        return view('genres.update-form', [
            'genre' => $genre,
        ]);
    }

    public function update(Request $request, Genre $genre)
    {
        Gate::authorize('update', $genre);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->name = $request->name;
        $genre->description = $request->description;
        $genre->save();

        return redirect()->route('genres.list')->with('status', "Genre '{$genre->name}' was updated successfully.");
    }

    public function delete(Genre $genre)
    {
        Gate::authorize('delete', $genre);
        $genreName = $genre->name;
        $genre->delete();

        return redirect()->route('genres.list')->with('status', "Genre '{$genreName}' was deleted successfully.");
    }
}
