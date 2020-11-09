@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>You have {{ count($bookings) }} booking(s).</h1>
                <div class="d-flex flex-row flex-wrap justify-content-between">
                
                @foreach ($bookings as $booking)

                    <div class="card mt-2" style="width: 18rem;">
                        <img src="/storage/{{ $booking->image }}" class="card-img-top" alt="VenueImage">
                        <div class="card-body">
                            <h5 class="card-title">{{$booking->v_name}}::{{$booking->s_description}}</h5>
                            <p class="card-text">Booking time: {{$booking->timing}}<br>
                            Duration: {{$booking->duration}} hour(s)</p>
                            <a href="/booking/{{$booking->b_id}}" class="btn btn-secondary">Delete Booking</a>
                        </div>
                    </div>

                @endforeach
                
                </div>
                @if (count($bookings) == 0)
                    <h1>You do not have any booking.</h1>
                @endif

            </div>
        </div>
    </div>
@endsection
