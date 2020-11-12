@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="width: 30rem;">
                    <h4 class="card-header">
                        Delete Venue
                    </h4>
                    <img src="/storage/{{ $venue->image }}" class="card-img-top" alt="VenueImage">
                    <div class="card-body">
                        <h5 class="card-title">{{ $venue->name }}</h5>
                        <p class="card-text">{{ $venue->description }}</p>
                        <form action="/venue/{{ $venue->id }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete Venue</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
