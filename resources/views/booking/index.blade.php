@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to booking index - to book your booking for user </h1>

                <h1>You have {{ count($bookings) }} booking(s).</h1>
                @foreach ($bookings as $booking)
                    {{-- <h1>{{ $booking->userID }}</h1>
                    <h1>This is venue information{{ $booking->v_name }}</h1>
                    <h1>This is venue information{{ $booking->timing }}</h1>
                    <h1>This is venue information{{ $booking->duration }}</h1> --}}

                    {{-- <a href="#">Edit</a>
                    <a href="#">Delete</a> --}}

                    <div class="card" style="width: 25vw;">
                        <img src="/storage/{{ $booking->image }}" class="card-img-top" alt="VenueImage">
                        <div class="card-body">
                            <h5 class="card-title">{{$booking->v_name}}</h5>
                            <p class="card-text">Booking time: {{$booking->timing}}<br>
                            Duration: {{$booking->duration}}</p>
                            {{-- <a href="#" class="btn btn-primary">Edit Booking</a> --}}
                            <a href="/booking/{{$booking->b_id}}" class="btn btn-danger">Delete Booking</a>
                        </div>
                    </div>


                @endforeach
                @if (count($bookings) == 0)
                    <h1>You do not have any booking.</h1>
                @endif





                {{-- <form action="/booking" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="slotID" value={{ $slot->id }}>
                        <input type="hidden" name="userID" value={{ $user->id }}>
                        <button type="submit" class="btn btn-primary">Confirm Booking Slots</button>
                    </div>

                </form> --}}
            </div>
        </div>
    </div>
@endsection
