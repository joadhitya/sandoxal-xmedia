@extends('layouts.main')
@section('content')

<style>
    :root {
        --primary-color: red;
        --dark-color: #141414;
    }

    body {
        -webkit-font-smoothing: antialiased;
        background: #000;
        color: #898989;
    }


    .showcase {
        width: 100%;
        height: 95vh;
        position: relative;
        background: url('/img/bg.jpg') no-repeat center center/cover;
    }

    .showcase::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        background: rgba(0, 0, 0, 0.5);
        box-shadow: inset 110px 100px 250px #000, inset -110px -100px 250px #000;
    }


    .showcase-content {
        z-index: 2;
        position: relative;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
    }


    .showcase-content h1 {
        /* font-weight: ; */
        font-size: 5rem;
        line-height: 1.1;
        margin: 0 0 2rem;
    }

    .showcase-content p {
        text-transform: uppercase;
        color: whitesmoke;
        /* font-weight:700; */
        font-size: 1.9rem;
        line-height: 1.2;
        margin: 0 0 2rem;
    }


    .btn {
        display: inline-block;
        background: var(--primary-color);
        color: whitesmoke;
        padding: .3rem 1.3rem;
        font-size: 1rem;
        text-align: center;
        border: none;
        cursor: pointer;
        margin-right: 0.5rem;
        outline: none;
        box-shadow: 0 1.5px 0 rgba(0, 0, 0, 0.3);
        border-radius: 2px;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-rounded {
        border-radius: 7px;
    }

    .btn-xl {
        font-size: 2rem;
        padding: 1.2rem 2.2rem;
        text-transform: uppercase;
    }



    .btn-lg {
        font-size: 1rem;
        padding: 0.8rem 1.3rem;
        text-transform: uppercase;
    }

    .tabs {
        background: var(--dark-color);
        padding-top: 1rem;
        border-bottom: 2.5 solid #3d3d3d;
    }

    .tabs .container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 1rem;
        align-items: center;
        justify-content: center;
        text-align: center;
    }


    .tabs p {
        font-size: 1.3rem;
        padding-top: 0.4rem;
    }

    .tabs .container>div {
        padding: 1.5rem 0;
    }

    .tabs .container>div:hover {
        cursor: pointer;
        /* color: rgb(255, 136, 0); */
        color: whitesmoke
    }

    .tab-border {
        border-bottom: 5px solid red;
    }

    /* Tab Content */
    .tab-content {
        padding: 3rem 0;
        background: black;
        color: white;
    }

    .tab-content .container {
        max-width: 90%;
        margin: auto;
        overflow: hidden;
        padding: 0 1.5rem;
    }


    /* Hide Content Intialy */
    #tab-1-content,
    #tab-2-content,
    #tab-3-content {
        display: none;
    }


    #tab-1-content .tab-1-content-inner {
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-gap: 1rem;
        align-items: center;
        justify-content: center;
    }

    #tab-2-content .tab-2-content-top {
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-gap: 1rem;
        /* grid-gap: 1rem; */
        align-items: center;
        justify-content: center;
    }

    #tab-2-content .tab-2-content-bottom {
        margin-top: 2rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 2rem;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .text-xl {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .text-lg {
        font-size: 1.6rem;
        margin-bottom: 1rem;
        color: white;
    }

    .text-md {
        font-size: 1.3rem;
        margin-bottom: .2rem;
        color: white;
    }

    .text-center {
        text-align: center;
    }

    .text-dark {
        color: #999;
    }

    .table {
        width: 100%;
        margin-top: 2rem;
        border-collapse: collapse;
        border-spacing: 0;
    }

    .table thead th {
        text-transform: uppercase;
        padding: 0.6rem;
    }

    .table tbody tr td {
        text-transform: uppercase;
        padding: 0.4rem;
        color: #888;
        text-align: center;
    }

    .table tbody tr td:first-child {
        text-align: left;
    }


    .table tbody tr:nth-child(odd) {
        background: #252525;
    }


    .footer {
        max-width: 70%;
        margin: 1rem auto;
        overflow: auto;
    }

    .footer,
    .footer a {
        color: #999;
        font-size: 0.9rem;
    }

    .footer p {
        margin-bottom: 1.5rem;
    }

    .footer .footer-cols {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 2rem;
    }

    .footer li {
        line-height: 1.9;
    }

    .footer .lang-select {
        margin-top: 2rem;
        color: #999;
        background-color: #000;
        background-image: none;
        border: 1px solid #333;
        padding: 1rem 1.2rem;
        border-radius: 5px;
    }

    .show {
        display: block !important;
        opacity: 1 !important;
        transition: all 1000 ease-in;
    }

    @media (max-width: 960px) {

        .showcase {
            height: 30vh;
        }

        .hide-sm {
            display: none;
        }

        .showcase-top img {
            top: 30%;
            left: 5%;
            transform: translate(0);
        }

        .showcase-content h1 {
            font-size: 3.7rem;
            line-height: 1;
        }

        .showcase-content p {
            font-size: 1.5rem;
        }

        .footer .footer-cols {
            grid-template-columns: repeat(2, 1fr);
        }

        .btn-xl {
            font-size: 1.5rem;
            padding: 1.4rem 2rem;
            text-transform: uppercase;
        }

        .text-xl {
            font-size: 1.5rem;
        }

        .text-lg {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .text-md {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
    }

    @media (max-width: 700px) {
        .showcase::after {
            background: rgba(0, 0, 0, 0.6);
            box-shadow: inset 80px 80px 150px #000000, inset -80px -80px 150px #000000;
        }

        .showcase-content h1 {
            font-size: 2.5rem;
            line-height: 1;
        }

        .showcase-content p {
            font-size: 1rem;
        }
    }

    @media(max-height: 600px) {
        .showcase-content {
            margin-top: 0;
        }
    }

</style>

<div class="showcase">
    <div class="showcase-content">
        <div class="container mx-auto px-4 pt-4">
            <div class="popular-tv">
                <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold text-center">Popular Shows</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($popularTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                    @endforeach
                </div>
            </div> <!-- end popular-tv -->

            <div class="top-rated-shows py-24">
                <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold text-center">Top Rated Shows</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($topRatedTv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                    @endforeach
                </div>
            </div> <!-- end top-rated-shows -->
        </div>
    </div>
</div>

@endsection
