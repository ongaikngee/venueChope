@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to delete timeslot</h1>


                <h3>Are you sure you want to delete the time slot.</h3>
                {{-- <p>my ID is {{ $venueId }}</p> --}}
                <p>Venue: {{ $venue->name }}</p>
                <p>Slot Description:{{$slot->description}}</p>
                <p>Start Time: {{ $slot->timing}}</p>
                <p>Duration: {{ $slot->duration }}Hour(s)</p>

                
                <form action="/slot/{{ $slot->id }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete Booking Slots</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
