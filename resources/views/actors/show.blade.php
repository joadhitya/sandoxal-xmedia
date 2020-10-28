@extends('layouts.main')
@section('content')

<style>
    .movie-img {
        /* height: 350px; */
        box-shadow: -4px 4px 5px #000;
    }

    .img-cast {
        height: 150px;
        margin-right: 10px;
        cursor: pointer;
    }

    .images-movie {
        width: 100%;
        margin-top: 20px;
        box-shadow: -4px 4px 5px #000;
        cursor: pointer;
        transition: 1s;
    }

    .images-movie:hover {
        transform: translateY(-10px);
    }

    .container {
        max-width: 85%;
    }

    @media (max-width: 800) {
        .master {
            padding-right: 0;
        }

        .movie-img {
            padding-right: 0;
        }
    }

    /* .elipsis {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 1200px;
        display: grid;
    } */


    .social-buttons a {
        display: inline-flex;
        text-decoration: none;
        font-size: 20px;
        width: 45px;
        height: 45px;
        color: #fff;
        justify-content: center;
        align-items: center;
        position: relative;
        margin: 0 8px;
    }

    .social-buttons a::before {
        content: "";
        position: absolute;
        width: 45px;
        height: 45px;
        background: linear-gradient(45deg, #2b262610, #4e4e53);
        border-radius: 50%;
        z-index: -1;
        transition: 0.3s ease-in;
    }

    .social-buttons a:hover::before {
        transform: scale(0);
    }

    .social-buttons a i {
        transition: 0.3s ease-in;
    }

    .social-buttons a:hover i {
        background: linear-gradient(45deg, #ffffff, #d8d8d8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transform: scale(2.2);
    }

    .cast-info {
        background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
            url('/img/bg.jpg');
        background-size: cover;
    }

    .cast-img {
        /* height: 350px; */
        box-shadow: 4px 4px 10px #fff;
        border-radius: 10px;
    }

    /* .social-buttons a:hover::before {
        transform: scale(0);
    } */
    .cast-img:hover {
        transition: 0.3s ease-in-out;
        transform: scale(1.05);
        cursor: pointer;
    }

    .images-movie {
        width: 100%;
        box-shadow: -4px 4px 5px #000;
        cursor: pointer;
        transition: 1s;
    }

    .images-movie:hover {
        transform: translateY(-10px);
    }

    .credit ul {
        counter-reset: index;
        padding: 0;
        max-width: 300px;
    }

    /* List element */
    .credit li {
        counter-increment: index;
        display: flex;
        align-items: center;
        padding: 1px 0;
        box-sizing: border-box;
        width: max-content;
    }


    /* Element counter */
    .credit li::before {
        content: counters(index, ".", decimal-leading-zero);
        font-size: 1.5rem;
        text-align: right;
        font-weight: bold;
        min-width: 50px;
        padding-right: 12px;
        font-variant-numeric: tabular-nums;
        align-self: flex-start;
        background-image: linear-gradient(to bottom, aquamarine, orangered);
        background-attachment: fixed;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }


    /* Element separation */
    .credit li+.credit li {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

</style>
<div class="cast-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="flex-none">
            <img src="{{ $actor['profile_path'] }}" alt="profile image" class="w-76  transition ease-in-out cast-img">
            <ul class="flex items-center mt-4 justify-center social-buttons">

                @if ($social['facebook'])
                <li>
                    <a href="{{ $social['facebook'] }}"><i class="fab fa-facebook"></i></a>
                </li>
                @endif

                @if ($social['instagram'])
                <li class="ml-6">
                    <a href="{{ $social['instagram'] }}"><i class="fab fa-instagram"></i></a>
                </li>
                @endif

                @if ($social['twitter'])
                <li class="ml-6">
                    <a href="{{ $social['twitter'] }}"><i class="fab fa-twitter"></i></a>
                </li>
                @endif
                @if ($actor['homepage'])

                <li class="ml-6">
                    <a href="{{ $actor['homepage'] }}" title="Website">
                        <svg class="fill-current text-gray-400 hover:text-white w-6" viewBox="0 0 496 512">
                            <path
                                d="M248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm82.29 357.6c-3.9 3.88-7.99 7.95-11.31 11.28-2.99 3-5.1 6.7-6.17 10.71-1.51 5.66-2.73 11.38-4.77 16.87l-17.39 46.85c-13.76 3-28 4.69-42.65 4.69v-27.38c1.69-12.62-7.64-36.26-22.63-51.25-6-6-9.37-14.14-9.37-22.63v-32.01c0-11.64-6.27-22.34-16.46-27.97-14.37-7.95-34.81-19.06-48.81-26.11-11.48-5.78-22.1-13.14-31.65-21.75l-.8-.72a114.792 114.792 0 01-18.06-20.74c-9.38-13.77-24.66-36.42-34.59-51.14 20.47-45.5 57.36-82.04 103.2-101.89l24.01 12.01C203.48 89.74 216 82.01 216 70.11v-11.3c7.99-1.29 16.12-2.11 24.39-2.42l28.3 28.3c6.25 6.25 6.25 16.38 0 22.63L264 112l-10.34 10.34c-3.12 3.12-3.12 8.19 0 11.31l4.69 4.69c3.12 3.12 3.12 8.19 0 11.31l-8 8a8.008 8.008 0 01-5.66 2.34h-8.99c-2.08 0-4.08.81-5.58 2.27l-9.92 9.65a8.008 8.008 0 00-1.58 9.31l15.59 31.19c2.66 5.32-1.21 11.58-7.15 11.58h-5.64c-1.93 0-3.79-.7-5.24-1.96l-9.28-8.06a16.017 16.017 0 00-15.55-3.1l-31.17 10.39a11.95 11.95 0 00-8.17 11.34c0 4.53 2.56 8.66 6.61 10.69l11.08 5.54c9.41 4.71 19.79 7.16 30.31 7.16s22.59 27.29 32 32h66.75c8.49 0 16.62 3.37 22.63 9.37l13.69 13.69a30.503 30.503 0 018.93 21.57 46.536 46.536 0 01-13.72 32.98zM417 274.25c-5.79-1.45-10.84-5-14.15-9.97l-17.98-26.97a23.97 23.97 0 010-26.62l19.59-29.38c2.32-3.47 5.5-6.29 9.24-8.15l12.98-6.49C440.2 193.59 448 223.87 448 256c0 8.67-.74 17.16-1.82 25.54L417 274.25z" />
                        </svg>
                    </a>
                </li>
                @endif

            </ul>
        </div>
        <div class="md:ml-24">
            <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $actor['name'] }}</h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm">
                <svg class="fill-current text-gray-400 hover:text-white w-4" viewBox="0 0 448 512">
                    <path
                        d="M448 384c-28.02 0-31.26-32-74.5-32-43.43 0-46.825 32-74.75 32-27.695 0-31.454-32-74.75-32-42.842 0-47.218 32-74.5 32-28.148 0-31.202-32-74.75-32-43.547 0-46.653 32-74.75 32v-80c0-26.5 21.5-48 48-48h16V112h64v144h64V112h64v144h64V112h64v144h16c26.5 0 48 21.5 48 48v80zm0 128H0v-96c43.356 0 46.767-32 74.75-32 27.951 0 31.253 32 74.75 32 42.843 0 47.217-32 74.5-32 28.148 0 31.201 32 74.75 32 43.357 0 46.767-32 74.75-32 27.488 0 31.252 32 74.5 32v96zM96 96c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40zm128 0c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40zm128 0c-17.75 0-32-14.25-32-32 0-31 32-23 32-64 12 0 32 29.5 32 56s-14.25 40-32 40z" />
                </svg>
                <span class="ml-2">{{ $actor['birthday'] }} ({{ $actor['age'] }} years old) in
                    {{ $actor['place_of_birth'] }}</span>
            </div>

            <p class="text-gray-300 mt-8 elipsis text-justify">
                {{ $actor['biography'] }}
            </p>

            <h4 class="font-semibold mt-8">Known For</h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                {{-- <div class="mt-2">
                    <a href=""><img src="/img/poster.jpg" alt="poster"
                            class="hover:opacity-100 transition ease-in-out duration-150 images-movie"></a>
                    <a href="" class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">Opopopo</a>
                </div> --}}

                @foreach ($knownForMovies as $movie)
                    <div class="mt-2">
                    <a href="{{ $movie['linkToPage'] }}"><img src="{{ $movie['poster_path'] }}" alt="poster"
                    class="hover:opacity-75 transition ease-in-out duration-150 images-movie"></a>
                <a href="{{ $movie['linkToPage'] }}"
                    class="text-sm leading-normal block text-gray-400 hover:text-white mt-1">{{ $movie['title'] }}</a>
            </div>

            @endforeach

        </div>
    </div>
</div>
</div> <!-- end movie-info -->

<div class="credits border-b border-gray-800">
    <div class="container mx-auto px-4 py-2 credit">
        <h2 class="text-4xl font-semibold text-uppercase">CREDITS</h2>
        <ul class="list-disc leading-loose pl-5">
            {{-- <li>2201 &middot;
                <strong><a href="" class="hover:underline">Avengers</a></strong>
                as Justie
            </li> --}}
            @foreach ($credits as $credit)
                <li>
                    {{ $credit['release_year'] }} &middot;
            <strong><a href="{{ $credit['linkToPage'] }}" class="hover:underline">{{ $credit['title'] }}</a></strong>&nbsp;
            as &nbsp;{{ $credit['character'] }}
            </li>
            @endforeach

        </ul>
    </div>
</div> <!-- end credits-->

@endsection
