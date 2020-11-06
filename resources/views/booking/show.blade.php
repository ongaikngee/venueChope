@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to booking show - to delete your booking for user </h1>

               <h1>are you sure you want to delete this booking?</h1>
                <form action="/booking/{{$booking->id}}" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="form-group">
                        <input type="hidden" name="_method" value="DELETE">
                        {{-- {{-- <input type="hidden" name="slotID" value={{ $slot->id }}> --}}
                        <input type="hidden" name="id" value={{ $booking->id }}> 
                        <button type="submit" class="btn btn-danger">Delete Booking Slots</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
