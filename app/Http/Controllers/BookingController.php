<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        // This is a join of 3 tables 
        $bookings = DB::table('bookings')
        ->leftJoin('slots', 'bookings.slotID', '=', 'slots.id')
        ->leftJoin('venues', 'slots.venueID', '=', 'venues.id')
        ->select(DB::raw('bookings.*, slots.*,venues.*, bookings.id as b_id, venues.name as v_name, slots.description as s_description'))
        ->where('bookings.userID', $user->id)
        ->orderBy('bookings.created_at','desc')
        ->get();


        return view('booking.index', ['bookings' => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slotID)
    {
        $user = Auth::user();
        $slot = Slot::where('id', $slotID)->first();
        $venue = Venue::where('id',$slot->venueID)->first();
    
        return view('booking.create', ['slot' => $slot, 'user'=>$user, 'venue'=>$venue]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = new Booking();
        $booking->userID = request('userID');
        $booking->slotID = request('slotID');

        $saved = $booking->save();
        if($saved){
            return redirect('/venue');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {

        $slot = Slot::where('id', $booking->slotID)->first();
        $venue = Venue::where('id',$slot->venueID)->first();
    
        return view('booking/show',['booking' => $booking, 'slot'=>$slot, 'venue'=>$venue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
        echo "welcome to destory";
        $delete = $booking->delete();
        if ($delete) {
            return redirect('/booking');
        }
    }
}
