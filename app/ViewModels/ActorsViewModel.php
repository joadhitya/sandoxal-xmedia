<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class ActorsViewModel extends ViewModel
{
    
    public $popularActors;
    public $page;
    public function __construct($popularActors,$page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors(){
        return collect($this->popularActors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? 'https://image.tmdb.org/t/p/w780/'.$actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name='.$actor['name'],
                'known_for' => collect($actor['known_for'])->where('media_type', 'movie')->pluck('title')->union(
                    collect($actor['known_for'])->where('media_type', 'tv')->pluck('name')
                )->implode(', '),
            ])->only([
                'profile_path', 'id', 'name', 'known_for'
            ]);
        });
        return collect($this->popularActors)->dump();
    }

    

    
}
