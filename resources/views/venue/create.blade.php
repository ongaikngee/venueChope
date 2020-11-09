@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h4 class="card-header">Create new Venue</h4>
            <div class="card-body">
                <form action="/venue" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label><br>
                        <input type="text" name="name" placeholder="Enter venue's name">
                    </div>
                    <div class="form-group">


                        <label for="description">Description</label><br>
                        <textarea rows="5" cols="100" name="description" placeholder="Enter venue's description"></textarea>

                    </div>

                    <div class="form-group">
                        <label for="image">Image</label><br>
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add venue</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
