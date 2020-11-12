@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @guest
                {{-- When no login credential is found --}}
                {{-- Ends at about line 81 --}}
                        <div class="container my-5">
                            <div class="row justify-content-center">
                                <div class="h2">Login to VenueChope.com to start booking your venues.</div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">{{ __('Login') }}</div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Login') }}
                                                        </button>

                                                        @if (Route::has('password.request'))
                                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                {{ __('Forgot Your Password?') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @else
                    
                    {{-- admin only  --}}
                    {{-- To show an admin is login  --}}
                    @if (Auth::user()->usertype=='admin')
                        <div class = "row justify-content-center">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Administrator Previlege.</h4>
                                <p>This access is a privilege access.<br> Please contact the administator if you are not authorise to access this.
                                <br>Administrator Email : admin@venuechope.com</p>
                            <hr>
                                <p>You are allow to:</p>
                                <ul>
                                    <li>Add/Edit/Delete Venues.</li>
                                    <li>Add/Edit/Delete Booking slots.</li>
                                    <li>Edit/Delete Users.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row m-1">
                            <ul class="list-group list-group-horizontal">
                                <a href="/venue/create" class="list-group-item list-group-item-danger list-group-item-action">
                                <i class="h5 fas fa-plus-circle"></i> Add Venue 
                                </a>
                            </ul>
                        </div>
                    @endif
                @endguest
                <div class="row m-1">

                    {{-- if no venue is created  --}}
                    @if (count($venues)==0)
                        <div class="container my-5">
                            <div class="alert alert-primary justify-content-center" role="alert">
                            <h4 class="alert-heading">No venue created yet.</h4>
                            <p>Click on the "Add Venue" button to create venues for booking. </p>
                            </div>
                        </div>

                    {{-- Display all the venues in venues table  --}}
                    @else
                        @foreach ($venues as $venue)
                            <div class="col-12 col-lg-6">
                                <div class="card my-2 border border-secondary">
                                    <img src="/storage/{{ $venue->image }}" class="card-img-top" alt="VenueImage">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $venue->name }}</h5>
                                        <p class="card-text">{{ $venue->description }}</p>
                                        <hr>
                                        {{-- Displaying of Booking Slots table --}}
                                        {{-- will end at about line 226  --}}
                                        <strong>Booking Slots</strong>
                                        <table class="table table-sm table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Start Time</th>
                                            <th scope="col">Duration</th>
                                            <th scope="col">
                                                @guest
                                                @else 
                                                    {{-- admin only --}}  
                                                    {{-- if admin is logged, a create booking slots button is display --}}
                                                    {{-- if user us logged, Just a "Book" title is display  --}}
                                                    @if (Auth::user()->usertype=='admin')
                                                        <div>
                                                            <a href="/slot/create/{{ $venue->id }}">
                                                                <i class="h4 far fa-calendar-plus" data-toggle="tooltip" title="Add Booking Slot"></i></a>
                                                        </div>
                                                    {{-- User only  --}}
                                                    @elseif (Auth::user()->usertype=='user')
                                                        <span>Book</span>
                                                    @endif
                                                @endguest</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Get Slots information --}}
                                            <?php $slotsCount = 0; ?>
                                            @foreach ($slots as $slot)
                                                @if ($slot->venueID == $venue->id)
                                                    <?php $slotsCount++; ?>
                                                    <tr>
                                                        <th scope="row">{{ $slot->description }}</th>
                                                        {{-- formatting the time. e.g from 08:00:00 to 8am  --}}
                                                        {{-- g in php show hour without leading zero --}}
                                                        <td>{{date('g A', strtotime($slot->timing))}}</td>
                                                        <td>{{ $slot->duration }} hour(s)</td>
                                                        {{-- For action buttons --}}
                                                        <td>
                                                            @guest
                                                            @else
                                                                {{-- Check if any slots was booked by any users. --}}
                                                                <?php
                                                                    $isbooked = false;
                                                                    foreach ($bookings as $booking){
                                                                        if (($slot->id == $booking->slotID)){
                                                                            $isbooked = true;
                                                                        }
                                                                    }
                                                                ?>

                                                                {{-- different action button is display depending on user type. --}}
                                                                {{-- Admin will get edit and delete action button. --}}
                                                                {{-- User will get booking action button  --}}

                                                                {{-- admin only --}}    
                                                                @if (Auth::user()->usertype=='admin')
                                                                    <div>
                                                                        @if ($isbooked)
                                                                            <i class="h4 text-secondary far fa-calendar-check" data-toggle="tooltip" title="Slot Booked."></i>
                                                                            <i class="h4 text-secondary far fa-calendar-times" data-toggle="tooltip" title="Slot Booked."></i>
                                                                        @else                   
                                                                            <a href="/slot/{{ $slot->id }}/edit">
                                                                                <i class="h4 far fa-calendar-check" data-toggle="tooltip" title="Edit Booking Slot"></i></a>
                                                                            <a href="/slot/{{ $slot->id }}">
                                                                                <i class="h4 far fa-calendar-times" data-toggle="tooltip" title="Delete Booking Slot"></i></a>
                                                                        @endif
                                                                    </div>
                                                                {{-- User only  --}}
                                                                @elseif (Auth::user()->usertype=='user')
                                                                    <div>
                                                                        @if ($isbooked)
                                                                            <p>Booked</p>
                                                                        @else
                                                                            <a href="/booking/create/{{ $slot->id }}">
                                                                            <i class="h4 far fa-calendar-check" data-toggle="tooltip" title="Slot available for booking."></i></a>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endguest
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            {{-- Display if no slots is created in this venue  --}}
                                            @if ($slotsCount == 0)
                                                <tr>
                                                    <td colspan="4">No booking slots created yet.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        </table>
                                        {{-- End of Booking Slots table --}}
                                        {{-- Starts at about line 131 --}}


                                        {{-- Display of edit and delete Venue buttons  --}}
                                        {{-- admin only --}}
                                        @guest
                                        @else
                                            @if (Auth::user()->usertype=='admin')
                                                <ul class="list-group list-group-horizontal">
                                                    <a href="/venue/{{ $venue->id }}/edit"
                                                        class="list-group-item list-group-item-danger list-group-item-action">
                                                        <i class="h5 far fa-edit"></i>
                                                        Edit Venue</a>
                                                    <a href="venue/{{ $venue->id }}"
                                                        class="list-group-item list-group-item-danger list-group-item-action @if($slotsCount!=0) disabled @endif">
                                                        <i class="h5 far fa-trash-alt"></i>
                                                        Delete Venue</a>
                                                </ul>
                                            @endif
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
