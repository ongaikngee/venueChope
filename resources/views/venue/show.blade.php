@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to delete page</h1>
                <p>I am inside venue folder in show page</p>
                <h1>{{ $venue->id }}</h1>
                {{-- if-match=”q1w2e3r4t5” --}}
                <form action="/venue/{{ $venue->id }}" method="POST">


                    <h1>Are you sure you want to delete this venue?</h1>
                    <h1>{{ $venue->name }}</h1>
                    <p>{{ $venue->description }}</p>
                    <img src="/storage/{{ $venue->image }}" alt="VenueImg">
                    @csrf
                    {{-- {{ method_field('DELETE') }} --}}
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete</button>


                    {{-- you need to use the proper form from bootstrap
                    --}}

                </form>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-12">
                {!! Form::open(['method' => 'Delete', 'route' => ['venue.destroy', $id]]) !!}
                <button type="submit" class="btn">Delete article</button>
                {!! Form::close() !!}
            </div>
        </div> --}}

    </div>
@endsection
