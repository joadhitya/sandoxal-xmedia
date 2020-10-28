@extends('layouts.main')
@section('content')
<style>
    .text-lg {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: white;
    }

    .card-actors {
        position: relative;
        height: 300px;
        width: 200px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.3);
        transition: 0.3s ease-out;
    }

    .card-actors:hover {
        box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
    }

    .card-actors .image {
        background: #000;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 2;
        transition: transform 0.3s ease-out;
    }

    .card-actors:hover .image {
        transform: translateY(-100px);
    }

    .image img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease-out;
    }

    .card-actors:hover .image img {
        opacity: 0.8;
    }

    .card-actors:hover .image {
        transform: translateY(-63px);
    }

    .card-actors .content {
        position: relative;
        width: 100%;
        height: 100%;
        background: #fff;
    }

    .info {
        position: absolute;
        bottom: 5px;
        text-align: center;
        width: 100%;
        color: #000;
        line-height: 19px;
    }

    .info h2 {
        font-size: 18px;
        margin: 3px 0;
    }

    .info span {
        font-size: 12px;
        color: #1a1a1a;
    }

    .elipsis {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 150px;
        display: inline-block;
    }
    .elipsis-name {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 180px;
        display: inline-block;
    }

</style>
<div class="container mx-auto px-4 pt-8">
    <div class="popular-actors">
        <h1 class="uppercase tracking-wider text-center text-lg font-semibold">Actors</h1>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            {{-- CARD ACTOR --}}
            @foreach ($popularActors as $actor)
            <div class="actor">
                
            <div class="card-actors mt-6">
                <div class="image">
                    <a href="{{ route('actors.show', $actor['id']) }}">

                        <img src="{{ $actor['profile_path']}}">
                    </a>
                </div>
                <div class="content">
                    <div class="info">
                        <h2 class="elipsis-name">{{ $actor['name']}}</h2>
                        <span class="elipsis">{{ $actor['known_for']}}</span>
                    </div>
                </div>
            </div>
            </div>
            @endforeach
            {{-- CARD ACTOR --}}
        </div>
    </div>

    <div class="page-load-status my-8">
        <div class="flex justify-center">
            <div class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</div>
        </div>
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error">Error</p>
    </div>


    {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/actors/page/{{ $previous }}">Previous</a>
    @else
    <div></div>
    @endif


    @if ($next)
    <a href="/actors/page/{{ $next }}">Next</a>
    @else
    <div></div>
    @endif

</div> --}}
</div>

@endsection


@section('scripts')
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    var elem = document.querySelector('.grid');
    var infScroll = new InfiniteScroll(elem, {
        path: '/actors/page/@{{#}}',
        append: '.actor',
        status: '.page-load-status',
        // history: false,
    });

</script>
@endsection
