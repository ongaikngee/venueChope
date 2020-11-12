<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Venue;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($venueId)
    {
        // To create a booking slot, venueID is required to enter to Slots Table 
        $venue = Venue::where('id', $venueId)->first();
        return view("slot.create", ['venue' => $venue]);
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
            'description' => 'required',
            'timing' => 'required',
            'duration' => 'required',
        ]);

        $slot = new Slot();

        //prepare the time
        $hour = request('timing');
        $timing = $hour . ":00";

        // Getting data 
        $slot->description = request('description');
        $slot->timing = $timing;
        $slot->duration = request('duration');
        $slot->venueID = request('venueID');

        $saved = $slot->save();
        if ($saved) {
            return redirect('/venue');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function show(Slot $slot)
    {
        $venue = Venue::where('id', $slot->venueID)->first();
        return view('slot/show', ['slot' => $slot, 'venue' => $venue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function edit(Slot $slot)
    {
        $venue = Venue::where('id', $slot->venueID)->first();
        return view('slot/edit', ['slot' => $slot, 'venue' => $venue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slot $slot)
    {
        $data = request()->validate([
            'description' => 'required',
            'timing' => 'required',
            'duration' => 'required',
        ]);

        //prepare the time
        $hour = request('timing');
        $timing = $hour . ":00";

        // Getting the updated data 
        $slot->description = request('description');
        $slot->timing = $timing;
        $slot->duration = request('duration');
        $slot->venueID = request('venueID');


        $saved = $slot->save();
        // if it saved, we send them to the venue page
        if ($saved) {
            return redirect('/venue');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slot $slot)
    {
        $delete = $slot->delete();
        if ($delete) {
            return redirect('/venue');
        }
    }
}
