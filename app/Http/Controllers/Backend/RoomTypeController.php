<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;
use Carbon\Carbon;

class RoomTypeController extends Controller
{
    public function RoomTypeList(){
        $allData = RoomType::orderBy('id','desc')->get();
        return view('backend.allrooms.roomtype.view_roomtype',compact('allData'));
    }
    public function AddRoomType(){
        return view('backend.allrooms.roomtype.add_roomtype');
    }

    public function AddRoomStore(Request $request){
        $roomtype_id = RoomType::insertGetId([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        Room::insert([
            'roomtype_id' => $roomtype_id,
        ]);

        $notification = array(
            'message' => 'Room Type Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('roomtype.list')->with($notification);
    }
}
