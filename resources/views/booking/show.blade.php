@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="card" style="width: 30rem;">
                    <h4 class="card-header">
                        Delete Booking
                    </h4>
                    <img src="/storage/{{ $venue->image }}" class="card-img-top" alt="VenueImage">
                    <div class="card-body">
                        <h5 class="card-title">{{ $venue->name }}::{{$slot->description}}</h5>
                        <p class="card-text">Booking Start Time: {{ $slot->timing }}
                            <br>Duration: {{ $slot->duration }} hour(s)
                        </p>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a>
                        --}}

                        <form action="/booking/{{ $booking->id }}" enctype="multipart/form-data" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" name="_method" value="DELETE">
                                {{--
                                {{-- <input type="hidden" name="slotID" value={{ $slot->id }}>
                                --}}
                                <input type="hidden" name="id" value={{ $booking->id }}>
                                <button type="submit" class="btn btn-danger">Delete Booking Slots</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    @endsection
