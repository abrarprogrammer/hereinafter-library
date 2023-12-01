@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($books as $book)
                <div class="col mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">{{ $book->name }}</h5>
                                <p>
                                    <span class="fw-bolder">Authors: </span>
                                    @foreach ($book->authors as $author)
                                        {{ $author->name }}
                                        @if (!$loop->last)
                                            , 
                                        @endif
                                    @endforeach
                                </p>
                                <p>
                                    <span class="fw-bolder">Publisher: </span>
                                    {{ $book->publisher_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4 d-flex justify-content-around">
                    <a href="?page={{ $previous_page }}" class="btn btn-primary w-25">Previous</a>
                    <a href="?page={{ $next_page }}" class="btn btn-primary w-25">Next</a>
                </div>
            </div>
        </div>
    </section>
    
@endsection