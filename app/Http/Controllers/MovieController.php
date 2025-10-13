<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MovieController extends Controller
{
    use AuthorizesRequests;


    public function showHomepage()
    {
        $latestMovies = Movie::with('genre')->latest()->take(4)->get();
        return view('home.index', ['latestMovies' => $latestMovies]);
    }


    public function list(Request $request)
    {
        $query = Movie::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('genre')) {
            $query->where('genre_code', $request->genre);
        }

        $movies = $query->with('genre')->paginate(12)->withQueryString();

        $genres = Genre::all();

        return view('movies.list', [
            'movies' => $movies,
            'genres' => $genres,
            'search' => $request->search,
            'selectedGenre' => $request->genre,
        ]);
    }


    public function view(Movie $movie)
    {
        $movie->load('providers', 'reviews.user');
        return view('movies.view', ['movie' => $movie]);
    }


    public function createForm()
    {
        $this->authorize('create', Movie::class);
        $genres = Genre::all();
        return view('movies.create-form', ['genres' => $genres]);
    }


    public function create(Request $request)
    {
        $this->authorize('create', Movie::class);
        $request->validate([
            'title' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1888',
            'genre_code' => 'required|string|exists:genres,code',
            'synopsis' => 'nullable|string',
            'poster_url' => 'nullable|url',
        ]);
        Movie::create($request->all());
        return redirect()->route('movies.list')->with('status', "Movie '{$request->title}' was added successfully.");
    }


    public function updateForm(Movie $movie)
    {
        $this->authorize('update', $movie);
        $genres = Genre::all();
        $providers = Provider::all();
        return view('movies.update-form', [
            'movie' => $movie,
            'genres' => $genres,
            'providers' => $providers,
        ]);
    }


    public function update(Request $request, Movie $movie)
    {
        $this->authorize('update', $movie);
        $request->validate([
            'title' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1888',
            'genre_code' => 'required|string|exists:genres,code',
            'synopsis' => 'nullable|string',
            'poster_url' => 'nullable|url',
            'providers' => 'nullable|array',
            'providers.*' => 'exists:providers,id'
        ]);
        $movie->update($request->except('providers'));
        $movie->providers()->sync($request->input('providers', []));
        return redirect()->route('movies.view', ['movie' => $movie->id])->with('status', "Movie '{$movie->title}' was updated successfully.");
    }


    public function delete(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movieTitle = $movie->title;
        $movie->delete();
        return redirect()->route('movies.list')->with('status', "Movie '{$movieTitle}' was deleted successfully.");
    }
}
