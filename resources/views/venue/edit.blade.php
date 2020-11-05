@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to venue edit Page</h1>
                <p>I am inside venue folder in edit page</p>


                <form action="/venue/{{$venue->id}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Enter venue's name" value="{{$venue->name}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" placeholder="Enter venue's description"  value="{{$venue->description}}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image"  value="{{$venue->image}}"><br>
                        <img src="/storage/{{$venue->image}}">
                    </div>

                    <div class="form-group">
                    @csrf
                    {{-- {{ method_field('PUT') }} --}}
                    <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="btn btn-primary">Edit venue</button>
                    </div>



                </form>

                </form>
            </div>
        </div>
    </div>
@endsection
