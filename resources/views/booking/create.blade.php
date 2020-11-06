@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to booking create - to book your booking for user </h1>
                <p>slotID: {{ $slot->id }}</p>
                <p>slotDescription: {{ $slot->description }}</p>
                <p>slottiming: {{ $slot->timing }}</p>
                <p>slotduration: {{ $slot->duration }}</p>
                <p>slotID: {{ $slot->id }}</p>
                <p>user: {{ $user->id }}</p>
                <p>name: {{ $user->name }}</p>
                <p>name: {{ $user->name }}</p>
                
                


                <form action="/booking" enctype="multipart/form-data" method="post">
                    @csrf
                    
                    <div class="form-group">
                        {{-- <input type="hidden" name="_method" value="PUT"> --}}
                        <input type="hidden" name="slotID" value={{ $slot->id }}>
                        <input type="hidden" name="userID" value={{ $user->id }}>
                        <button type="submit" class="btn btn-primary">Confirm Booking Slots</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
