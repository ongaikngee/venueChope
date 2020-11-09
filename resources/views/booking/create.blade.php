@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="width: 30rem;">
                    <h4 class="card-header">
                        Add Booking
                    </h4>
                    <img src="/storage/{{ $venue->image }}" class="card-img-top" alt="VenueImage">
                    <div class="card-body">
                        <h5 class="card-title">{{ $venue->name }} :: {{$slot->description}}</h5>
                        <p class="card-text">
                        Start Time: {{ date('g A', strtotime($slot->timing)) }}
                            <br>Duration: {{ $slot->duration }} hour(s)
                        </p>
                        <form action="/booking" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="slotID" value={{ $slot->id }}>
                                <input type="hidden" name="userID" value={{ $user->id }}>
                                <button type="submit" class="btn btn-primary">Confirm Booking Slots</button>
                            </div>

                        </form>


                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
