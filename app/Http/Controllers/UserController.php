<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')
        ->orderBy('usertype')
        ->get();

        $bookings = DB::table('bookings')->get();
        return view("user.index", ['users' => $user, 'bookings'=>$bookings]);
    }


    public function update(Request $request, User $user)
    {
        $user->id = request('id');
        $user->usertype = "admin";

        $saved = $user->save();
        if ($saved) {
            return redirect('/user');
        }
    }


    public function destroy(User $user)
    {
        $delete = $user->delete();
        if ($delete) {
            return redirect('/user');
        }
    }

}

?>