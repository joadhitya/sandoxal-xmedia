@extends('layouts.main')
@section('content')

<style>
    .tvshow-img {
        /* height: 350px; */
        box-shadow: -4px 4px 5px #000;
    }

    .img-cast {
        height: 150px;
        margin-right: 10px;
        cursor: pointer;
    }

    .images-tvshow {
        width: 100%;
        margin-top: 20px;
        box-shadow: -4px 4px 5px #000;
        cursor: pointer;
        transition: 1s;
    }

    .images-tvshow:hover {
        transform: translateY(-10px);
    }

    .container {
        max-width: 100%;
    }

    @media (max-width: 800) {
        .master {
            padding-right: 0;
        }

        .tvshow-img {
            padding-right: 0;
        }
    }

</style>

<?php
//  $bg = {{ 'https://image.tmdb.org/t/p/w300/'.$tvshow['backdrop_path'] }} 
?>
{{-- {{ 'https://image.tmdb.org/t/p/original/'.$tvshow['backdrop_path'] }}  --}}
<div class="container py-10 flex flex-col md:flex-row"
    style=" background-image: linear-gradient(rgba(0,0,0,0.8),rgba(0,0,0,0.8)),url({{$tvshow['backdrop_path']}});background-size: cover;">

    <div class="master md:ml-24" style="padding-right: 150px">
        <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{$tvshow['name']}}</h2>
        <div class="flex flex-wrap items-center text-gray-400 text-sm">
            <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                <g data-name="Layer 2">
                    <path
                        d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z"
                        data-name="star" />
                </g>
            </svg>
            <span class="ml-1">{{$tvshow['vote_average']}}</span>
            <span class="mx-2">|</span>
            <span>{{ $tvshow['first_air_date'] }}</span>
            <span class="mx-2">|</span>
            <span>{{ $tvshow['genres'] }}</span>
        </div>

        <p class="text-gray-300 mt-8">
            {{$tvshow['overview']}}
        </p>
        <div class="mt-4">
            <h4 class="text-white font-semibold">Featured Crew</h4>
            <div class="flex mt-4">
                @foreach ($tvshow['credits']['crew'] as $crew)
                @if ($loop->index < 4) <div class="mr-8">
                    <div>{{$crew['name']}}</div>
                    <div class="text-sm text-gray-400">{{$crew['job']}}</div>
            </div>
            @else
            @break
            @endif
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        <h4 class="text-white font-semibold">Cast</h4>
        <div class="mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">

                @foreach ($tvshow['credits']['cast'] as $cast)
                @if ($loop->index < 5) <div class="mr-2">
                    <div>
                        <a href="{{ route('actors.show', $cast['id']) }}">
                            <img class="img-cast" src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']}}"
                                name="{{$cast['name']}}" alt="">
                        </a>
                    </div>
                    <div class="text-sm text-gray-400">{{$cast['character']}}</div>
            </div>
            @else
            @break
            @endif
            @endforeach
        </div>
    </div>
</div>
</div>
<div class="flex-none">
    <img style="margin-right: 120px" class="w-64 lg:w-96 tvshow-img"
        src="{{ $tvshow['poster_path'] }}" alt="">
    {{-- <img src="{{ $tvshow['poster_path'] }}" alt="poster" class="w-64 lg:w-96"> --}}
    <div x-data="{ isOpen: false }">
        @if (count($tvshow['videos']['results']) > 0)
        <div class="mt-8">
            <button @click="isOpen = true"
                {{-- href="https://www.youtube.com/watch?v={{ $tvshow['videos']['results'][0]['key'] }}" --}}
                class="btn-custom flex inline-flex items-center" style="margin-left: 0">
                <svg class="w-6 fill-current" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                </svg>
                <span class="ml-2">Play Trailer</span>
            </button>
        </div>
        @endif


        {{-- <template x-if="isOpen"> --}}
        <div x-show='isOpen' style="background-color: rgba(0, 0, 0, .5);"
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="rounded">
                    <div class="flex justify-end pr-4 pt-1">
                        <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                            class="text-3xl leading-none hover:text-gray-300">&times;
                        </button>
                    </div>
                    <div class="modal-body px-8 py-8">
                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                src="https://www.youtube.com/embed/{{ $tvshow['videos']['results'][0]['key'] }}"
                                style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- </template> --}}
    </div>

</div>
</div>

<div class="tvshow-images" x-data="{ isOpen: false, image: ''}">
    <div class="container mx-auto px-5 py-8">
        <h2 class="text-4xl font-semibold text-center">IMAGES</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($tvshow['images'] as $image)
             <div class="mt-4">
                <a @click.prevent="
                isOpen = true
                image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
            " href="#">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path']}}" alt="image1"
                        class="hover:opacity-75 transition ease-in-out duration-150 images-tvshow">
                </a>
        </div>
        @endforeach
    </div>
    <div style="background-color: rgba(0, 0, 0, .5);"
        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" x-show="isOpen">
        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
            <div class="rounded">
                <div class="flex justify-end pr-4 pt-2">
                    <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                        class="text-3xl leading-none hover:text-gray-300">&times;
                    </button>
                </div>
                <div class="modal-body px-8 py-8">
                    <img :src="image" alt="poster">
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
