@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                {{-- admin only --}}
                @guest
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
                    <h1>{{ Auth::user()->usertype }}</h1>
                    <div class="row">
                        {{-- <a href="venue/create">Add Venue</a> --}}
                        <ul class="list-group list-group-horizontal">
                            <a href="/venue/create" class="list-group-item list-group-item-danger list-group-item-action">Add
                                Venue</a>
                        </ul>
                    </div>
                @endguest

                {{-- <div class="row d-flex flex-column flex-wrap justify-content-between"> --}}
                <div class="row">
                        @foreach ($venues as $venue)
                            <div class="col-12 col-lg-6">
                                {{-- <div class="card my-2 border border-secondary" style="width:33rem;"> --}}
                                <div class="card my-2 border border-secondary">
                                    <img src="/storage/{{ $venue->image }}" class="card-img-top" alt="VenueImage">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $venue->name }}</h5>
                                        <p class="card-text">{{ $venue->description }}</p>
                                        <hr>
                                        {{-- Display of slots --}}
                                        <h5 class="card-title">Booking Slots</h5>
                                        <p class="card-text">
                                        <ul class="list-group">
                                            <li
                                                class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                                                <span>Name</span>
                                                <span>Start time</span>
                                                <span>Duration</span>
                                                @guest
                                                @else 
                                                    <a class="text-danger" href="/slot/create/{{ $venue->id }}">add booking slots</a></a>
                                                @endguest
                                            </li>

                                            <?php $x = 0; ?>
                                        
                                            @foreach ($slots as $slot)
                                                @if ($slot->venueID == $venue->id)
                                                    <?php $x++; ?>
                                                

                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $slot->description }}
                                                        {{--
                                                        <span>{{ date('h A', $slot->timing) }}</span>
                                                        --}}
                                                        <span>{{ $slot->timing }}</span>
                                                        <span>{{ $slot->duration }} hour(s)</span>



                                                        {{-- admin only --}}
                                                        @guest
                                                        @else
                                                            <span class="badge badge-danger badge-pill"><a
                                                                    href="/slot/{{ $slot->id }}/edit">Edit</a></span>
                                                            <span class="badge badge-danger badge-pill"><a
                                                                    href="/slot/{{ $slot->id }}">Del</a></span>
                                                            <span class="badge badge-success badge-pill"><a
                                                                    href="/booking/create/{{ $slot->id }}">Book</a></span>
                                                        @endguest
                                                    </li>

                                                @endif

                                            @endforeach
                                            @if ($x == 0)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    No slots created yet!
                                                </li>
                                            @endif
                                            </p>

                                            {{-- admin only --}}
                                            @guest
                                            @else
                                                <ul class="list-group list-group-horizontal">
                                                    <a href="/venue/{{ $venue->id }}/edit"
                                                        class="list-group-item list-group-item-danger list-group-item-action">Edit
                                                        Venue</a>
                                                    <a href="venue/{{ $venue->id }}"
                                                        class="list-group-item list-group-item-danger list-group-item-action">Delete
                                                        Venue</a>
                                                </ul>
                                            @endguest

                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
