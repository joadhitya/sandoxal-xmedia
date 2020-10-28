<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular?api_key=62f1ce8468bbaa90985c2f939826ae40&language=en-US&page=1')
            ->json()['results'];
            // dump($popularMovies);
        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing?api_key=62f1ce8468bbaa90985c2f939826ae40&language=en-US&page=1')
            ->json()['results'];
        $topRatedMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/top_rated?api_key=62f1ce8468bbaa90985c2f939826ae40&language=en-US&page=1')
            ->json()['results'];

        // $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
        //     ->get('https://api.themoviedb.org/3/movie/now_playing')
        //     ->json()['results'];

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=62f1ce8468bbaa90985c2f939826ae40&language=en-US')
            ->json()['genres'];
        
            $genres = collect($genresArray)->mapWithKeys(function ($genre) {
                return [$genre['id'] => $genre['name']];
            });

        // dump($genres);
        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $topRatedMovies,
            $genres,
        );

        return view('movies.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
        ->get( 'https://api.themoviedb.org/3/movie/'.$id.'?api_key=62f1ce8468bbaa90985c2f939826ae40&append_to_response=credits,videos,images')
        ->json();
    //    dump($movie);
        $viewModel = new MovieViewModel($movie);

        return view('movies.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
