@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    {{-- <a href="venue/create">Add Venue</a> --}}
                    <ul class="list-group list-group-horizontal">
                    <a href="/venue/create" class="list-group-item list-group-item-danger list-group-item-action">Add Venue</a>
                    </ul>
                    <h1>I am the real index now!</h1>
                </div>
                <div class="row">

                    @foreach ($venues as $venue)
                        <div class="card m-2" style="width:40vw;">
                            <img src="/storage/{{ $venue->image }}" class="card-img-top" alt="VenueImage">
                            <div class="card-body">
                                <h5 class="card-title">{{ $venue->name }}</h5>
                                <p class="card-text">{{ $venue->description }}</p>

                                {{-- Display of slots --}}

                                <h5 class="card-title">Slots for booking</h5>
                                <p class="card-text">
                                <ul class="list-group">
                                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                                                Name
                                                <span>Slot start time</span>
                                                <span>Slot Duration</span>
                                                <span class="badge badge-primary badge-pill">88</span>
                                                <a href="/slot/create/{{$venue->id}}">add booking slots</a></a>
                                            </li>

                                    <?php $x = 0; $timestamp = time();  ?>
                                    @foreach ($slots as $slot)
                                        @if ($slot->venueID == $venue->id)
                                            <?php $x++; ?>

                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $slot->description }}
                                                {{-- <span>{{ date('h A', $slot->timing) }}</span> --}}
                                                <span>{{$slot->timing}}</span>
                                                <span>{{$slot->duration }} hour(s)</span>
                                                <span class="badge badge-danger badge-pill"><a href="/slot/{{$slot->id}}/edit">Edit</a></span>
                                                <span class="badge badge-danger badge-pill"><a href="/slot/{{$slot->id}}">Del</a></span>
                                                <span class="badge badge-success badge-pill"><a href="/booking/create/{{$slot->id}}">Book</a></span>
                                            </li>

                                        @endif

                                    @endforeach
                                    @if ($x == 0)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                No slots created yet!
                                            </li>
                                    @endif
                                </p>

                                {{-- Edit & Delete for Venue : Admin Access --}}
                                <ul class="list-group list-group-horizontal">
                                <a href="/venue/{{ $venue->id }}/edit" class="list-group-item list-group-item-danger list-group-item-action">Edit Venue</a>
                                <a href="venue/{{ $venue->id }}" class="list-group-item list-group-item-danger list-group-item-action">Delete Venue</a>
                                </ul>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
