@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">

                    @foreach ($venues as $venue)
                        < class="card m-2" style="width: 18rem;">
                            <img src="/storage/{{ $venue->image }}" class="card-img-top" alt="VenueImage">
                            <div class="card-body">
                                <h5 class="card-title">{{ $venue->name }}</h5>
                                <p class="card-text">{{ $venue->description }}</p>
                                {{-- <a href="#" class="btn btn-primary">Go somewhere</a>
                                --}}
                                <a href="/venue/{{ $venue->id }}/edit">Edit</a><br>
                                <a href="venue/{{ $venue->id }}">Delete</a>
                            </div>
                        </>
                    @endforeach
                </div>
                <div class="row">
                    <a href="venue/create">Add Venue</a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
