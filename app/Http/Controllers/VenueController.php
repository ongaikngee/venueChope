<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To get all records from the database for venue;
        $venue = Venue::all();
        $slots = Slot::all();
    
        //this is to sumulate data from the database slots
        // $slots = [];

        //slot is an array with the format
        //id, venueID, description, timing(H), duration(in hour)
        //venue 
        // $slot01 = [1, 13, "slot1", "2", "2"];
        // $slot02 = [2, 13, "slot2", "4", "2"];
        // $slot03 = [3, 13, "slot3", "6", "2"];
        // $slot04 = [4, 14, "slot1", "2", "2"];
        // $slot05 = [5, 14, "slot2", "4", "2"];
        // $slot06 = [6, 14, "slot3", "6", "2"];
        // Push the array 
        // array_push($slots, $slot01, $slot02, $slot03, $slot04, $slot05, $slot06);
        // print_r($slots);

        return view("venue.show", ['venues' => $venue, 'slots' => $slots]);
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
        return view('venue/delete', ['venue' => $venue]);
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
            'image' => ['required', 'image'],
        ]);
        $imagePath = request('image')->store('uploads', 'public');

        $venue->name = request('name');
        $venue->description = request('description');
        $venue->image = $imagePath;

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
