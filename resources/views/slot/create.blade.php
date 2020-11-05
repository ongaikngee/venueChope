@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to create timeslot</h1>
                <p>Creating booking slot for {{ $venue->name }}</p>


                <form action="/slot" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="description">Name of Slot</label>
                        <input type="text" name="description" placeholder="Enter name for slots">
                    </div>
                    <div class="form-group">
                        {{-- jon: want this to be calerdar or time selector
                        --}}
                        <label for="timing">Select Start Time</label>
                        <select name="timing">
                            <option value="8">8am</option>
                            <option value="9">9am</option>
                            <option value="10">10am</option>
                            <option value="11">11am</option>
                            <option value="12">12pm</option>
                            <option value="13">1pm</option>
                            <option value="14">2pm</option>
                            <option value="15">3pm</option>
                            <option value="16">4pm</option>
                            <option value="17">5pm</option>
                            <option value="18">6pm</option>
                            <option value="19">7pm</option>
                            <option value="20">8pm</option>
                            <option value="21">9pm</option>
                            <option value="22">10pm</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {{-- jon: want this to be a drop down Done!--}}
                         <label for="duration">Select Start Time</label>
                        <select name="duration">
                            <option value="0.5">30 mins</option>
                            <option value="1">1 hour</option>
                            <option value="1.5">1 hour 30 mins</option>
                            <option value="2">2 hours</option>
                            <option value="2.5">2 hours 30 mins</option>
                            <option value="3">3 hours</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="venueID" value={{ $venue->id }}>
                        <button type="submit" class="btn btn-primary">Add Booking Slots</button>
                    </div>



                </form>

            
            </div>
        </div>
    </div>
@endsection
