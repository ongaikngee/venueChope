@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>User Administration</h1>

        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Make Admin</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td scope="row">
                            {{ $user->name }}<br>
                            <span class="text-secondary">{{ $user->email }}</span><br>
                            {{-- Check to see if current user has any booking  --}}
                            @if ($user->usertype == 'user')
                                <?php $countBooking = 0 ?>
                                @foreach ($bookings as $booking )
                                    @if ($booking->userID == $user->id)
                                        <?php $countBooking++ ?>
                                    @endif
                                @endforeach
                                <span class="text-secondary">Active Booking : {{ $countBooking }}</span><br>
                            @endif
                        </td>

                        {{-- Edit user column--}}
                        <td>
                            @if ($user->usertype == 'user')

                                @if ($countBooking==0)
                                    <div data-toggle="modal" data-target="#ModalEdit{{ $user->id }}">
                                        <a href="#"><i class="h5 text-primary far fa-edit" data-toggle="tooltip"
                                                title="Make this user as Admin."></i></a>
                                    </div>

                                {{-- if user still have active booking, user cannot be edited.  --}}
                                @else
                                    <i class="h5 text-secondary far fa-edit" data-toggle="tooltip"
                                            title="User still have bookings. Edit disabled."></i></a>
                                @endif  

                            @elseif ($user->usertype == 'admin')
                                <p>Administration</p>
                            @endif


                            <div class="modal fade" id="ModalEdit{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Make user an Administrator?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $user->name }}<br><span class="text-secondary">{{ $user->email }}</span>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/user/{{ $user->id }}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Make Administrator</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>

                        {{-- Delete user column --}}
                        <td>
                        @if ($user->usertype == 'user')
                            @if ($countBooking==0)
                                <div data-toggle="modal" data-target="#ModalDel{{ $user->id }}">
                                    <a href="#"><i class="h5 text-danger far fa-trash-alt" data-toggle="tooltip" title="Delete this user."></i> </a>
                                </div>

                            @else
                                <i class="h5 text-secondary far fa-trash-alt" data-toggle="tooltip" title="User still have bookings. Deletion disabled."></i>
                        
                            @endif 

                        @else
                            @if(Auth::user()->id != $user->id)
                                <div data-toggle="modal" data-target="#ModalDel{{ $user->id }}">
                                    <a href="#"><i class="h5 text-danger far fa-trash-alt" data-toggle="tooltip" title="Delete this user."></i> </a>
                                </div>
                            @else   
                                <p>Log in.</p>
                            @endif
                        @endif
                            

                            <div class="modal fade" id="ModalDel{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete User?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $user->name }}<br><span class="text-secondary">{{ $user->email }}</span>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/user/{{ $user->id }}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>           
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
