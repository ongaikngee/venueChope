@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Welcome to venue Create Page</h1>
                <p>I am inside venue folder in create page</p>


                <form action="/venue" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Enter venue's name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" placeholder="Enter venue's description">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add venue</button>
                    </div>



                </form>

                </form>
            </div>
        </div>
    </div>
@endsection
