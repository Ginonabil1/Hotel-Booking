<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\MultiImage;
use App\Models\Facility;



class FrontendRoomController extends Controller
{
    public function FrontendRoomList(){
        $rooms = Room::latest()->get();
        return view('frontend.room.all_rooms' , compact('rooms'));
    }



    public function RoomDetailsPage($id){
        $room = Room::find($id);
        $images = MultiImage::where('rooms_id' , $id)->get();
        $facilities = Facility::where('rooms_id' , $id)->get();
        $recommend_rooms = Room::where('id' , '!=' , $id)->orderBy('id' , 'DESC')->limit(2)->get();

        return view('frontend.room.room_details' , compact('room' , 'images' ,'facilities' , 'recommend_rooms'));
    }
}
