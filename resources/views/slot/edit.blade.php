@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to edit timeslot</h1>
                <p>Venue: {{ $venue->name }}</p>
                
                <?php
                    //converting sql time to number
                    $time = $slot->timing;
                    $time = date("H",strtotime($time)); //extract the hour
                    $time = (int)$time; //convert to int
                ?>


                <form action="/slot/{{$slot->id}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="description">Name of Slot</label>
                        <input type="text" name="description" placeholder="Enter name for slots" value="{{$slot->description}}">
                    </div>
                    <div class="form-group">
                        {{-- jon: want this to be calerdar or time selector --}}
                        <label for="timing">Select Start Time</label>
                        <select name="timing">
                            <option @if ($time == 8){{"Selected"}} @endif value="8">8am</option>
                            <option @if ($time == 9){{"Selected"}} @endif value="9">9am</option>
                            <option @if ($time == 10){{"Selected"}} @endif value="10">10am</option>
                            <option @if ($time == 11){{"Selected"}} @endif value="11">11am</option>
                            <option @if ($time == 12){{"Selected"}} @endif value="12">12pm</option>
                            <option @if ($time == 13){{"Selected"}} @endif value="13">1pm</option>
                            <option @if ($time == 14){{"Selected"}} @endif value="14">2pm</option>
                            <option @if ($time == 15){{"Selected"}} @endif value="15">3pm</option>
                            <option @if ($time == 16){{"Selected"}} @endif value="16">4pm</option>
                            <option @if ($time == 17){{"Selected"}} @endif value="17">5pm</option>
                            <option @if ($time == 18){{"Selected"}} @endif value="18">6pm</option>
                            <option @if ($time == 19){{"Selected"}} @endif value="19">7pm</option>
                            <option @if ($time == 20){{"Selected"}} @endif value="20">8pm</option>
                            <option @if ($time == 21){{"Selected"}} @endif value="21">9pm</option>
                            <option @if ($time == 22){{"Selected"}} @endif value="22">10pm</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {{-- jon: want this to be a drop down --}}
                         <label for="duration">Select Start Time</label>
                        <select name="duration">
                            <option @if ($slot->duration == 0.5){{"Selected"}} @endif value="0.5">30 mins</option>
                            <option @if ($slot->duration == 1){{"Selected"}} @endif value="1">1 hours</option>
                            <option @if ($slot->duration == 1.5){{"Selected"}} @endif value="1.5">1 hours 30 mins</option>
                            <option @if ($slot->duration == 2){{"Selected"}} @endif value="2">2 hours</option>
                            <option @if ($slot->duration == 2.5){{"Selected"}} @endif value="2.5">2 hours 30 mins</option>
                            <option @if ($slot->duration == 3){{"Selected"}} @endif value="3">3 hours</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="venueID" value={{ $venue->id }}>
                        <button type="submit" class="btn btn-primary">Edit Booking Slots</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
