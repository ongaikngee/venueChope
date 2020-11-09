@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h4 class="card-header">
                Delete Booking Slot
            </h4>
            <div class="card-body">
                <h5 class="card-title">Venue: {{ $venue->name }} :: {{ $slot->description }}</h5>
                <p class="card-text">
                Start Time: {{ $slot->timing }}<br>
                Duration: {{ $slot->duration }}Hour(s)</p>
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
