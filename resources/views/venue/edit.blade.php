@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h4 class="card-header">
                Edit Venue
            </h4>
            <div class="card-body">
            <form action="/venue/{{ $venue->id }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label><br>
                        <input type="text" name="name" placeholder="Enter venue's name" value="{{ $venue->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label><br>
                        <textarea rows="5" cols="50" name="description"
                            placeholder="Enter venue's description">{{ $venue->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label><br>
                        <input type="file" name="image" value="{{ $venue->image }}"><br>
                        <img width=50%" src="/storage/{{ $venue->image }}">
                    </div>

                    <div class="form-group">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="btn btn-primary">Edit venue</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
