<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //This is the 1st controller when the page is loaded
        //Create the default Admin user here. 
        $user = User::firstOrCreate(
            ['email'=>'admin@venuechope.com'], 
            ['name'=>'Administrator',
            'password'=>Hash::make(12345678),
            'usertype'=>'admin']
        );

        //To get all records from the database for venue;
        $venue = Venue::all();
        $slots = DB::table('slots')
        ->orderBy('timing')
        ->get();

        $bookings = Booking::all();
        return view("venue.index", ['venues' => $venue, 'slots' => $slots, 'bookings'=>$bookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("venue.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => ['required', 'image'],
        ]);

        $venue = new Venue();
        $imagePath = request('image')->store('uploads', 'public');

        $venue->name = request('name');
        $venue->description = request('description');
        $venue->image = $imagePath;

        $saved = $venue->save();
        if ($saved) {
            return redirect('/venue');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        return view('venue.show', ['venue' => $venue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        return view('venue/edit', ['venue' => $venue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        $data = request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);


        //Update the image if it is uploaded. 
        if (request('image')!=""){
            echo request('image');
            $imagePath = request('image')->store('uploads', 'public');
            $venue->image = $imagePath;
        }

        $venue->name = request('name');
        $venue->description = request('description');

        $saved = $venue->save();
        // if it saved, we send them to the venue page
        if ($saved) {
            return redirect('/venue');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        $delete = $venue->delete();
        if ($delete) {
            return redirect('/venue');
        }
    }
}
