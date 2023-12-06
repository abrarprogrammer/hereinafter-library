@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div id="books-section" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                {{-- It will be populated by AJAX --}}
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4 d-flex justify-content-around">
                    <button id="previous-page" class="btn btn-primary w-25">Previous</button>
                    <button id="next-page" class="btn btn-primary w-25">Next</button>
                </div>
            </div>
        </div>
    </section>
    
@endsection