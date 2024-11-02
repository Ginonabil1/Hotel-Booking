<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Carbon\Carbon;

class RoomController extends Controller
{


    public function RoomEdit($id){
        $basic_facility = Facility::where('rooms_id',$id)->get();
        $multiimg = MultiImage::where('rooms_id',$id)->get();
        $room_nb = RoomNumber::where('rooms_id',$id)->get();
        $room_edit = Room::find($id);
        return view('backend.allrooms.rooms.edit_room', compact('room_edit' , 'basic_facility' , 'multiimg' , 'room_nb'));
    }





    public function RoomUpdate(Request $request , $id){
        $room  = Room::find($id);
        $room->roomtype_id = $room->roomtype_id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->price;

        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style;
        $room->discount = $request->discount;
        $room->short_desc = $request->short_desc;
        $room->description = $request->description; 
        $room->status = 1; 

        /// Update Single Image 

        if($request->file('image')){

        $file = $request->file('image');
        @unlink(public_path('upload/room/'.$room->image)); // no duplicate images just upload one
        $filename = date('YmdHi') . $file->getClientOriginalName();  
        $file->move(public_path('upload/room'), $filename);
        $room['image'] = $filename; 
        }

        $room->save();


        // Update facility Table
        if($request->facility_name == NULL){

            $notification = array(
                'message' => 'Sorry! Not Any Basic Facility Select',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        } else{
            Facility::where('rooms_id',$id)->delete();
            $facilities = Count($request->facility_name);
            for($i=0; $i < $facilities; $i++ ){
                $fcount = new Facility();
                $fcount->rooms_id = $room->id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->save();
            } // end for
        } // end else 


        //Update MultiImg table
        if($room->save()){
            $files = $request->multi_img;
            if(!empty($files)){
                $subimage = MultiImage::where('rooms_id',$id)->get()->toArray();
                MultiImage::where('rooms_id',$id)->delete();

            }
            if(!empty($files)){
                foreach($files as $file){
                    $imgName = date('YmdHi').$file->getClientOriginalName();
                    $file->move('upload/room/multi_img/',$imgName);
                    $subimage['multi_img'] = $imgName;

                    $subimage = new MultiImage();
                    $subimage->rooms_id = $room->id;
                    $subimage->multi_img = $imgName;
                    $subimage->save();
                }

            }
        } // end if

        $notification = array(
            'message' => 'Room Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
    





    public function MultiImgDelete($id){
        $deletedata = MultiImage::where('id',$id)->first();
    
        if($deletedata){
            $imagePath = 'upload/room/multi_img/' . $deletedata->multi_img;
    
            // Check if the file exists before unlinking 
            if (file_exists($imagePath)) {
                @unlink($imagePath); // Corrected the concatenation
    
                echo "Image Deleted Successfully";
            } else {
                echo "Image does not exist";
            }
    
            //  Delete the record from the database 
            MultiImage::where('id', $id)->delete();
        }
    
        $notification = array(
            'message' => 'Image Deleted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification); 
    }
    

// -------------------------------------------------------------------------------------

    // Room Number


    public function RoomNumberStore(Request $request , $id){
        $room_number = new RoomNumber;

        $room_number->rooms_id = $id;
        $room_number->roomtype_id = $request->roomtype_id;
        $room_number->romm_nb = $request->room_nb;
        $room_number->status = $request->status;

        $room_number->save();

        $notification = array(
            'message' => 'Room Number Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }




    public function RoomNumberEdit($id){
        $room_number = RoomNumber::find($id);

        return view('backend.allrooms.rooms.edit_room_nb' , compact('room_number'));
    }




    public function RoomNumberDelete($id){
        RoomNumber::where('id',$id)->delete();
        
        $notification = array(
            'message' => 'Room Number Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }



    public function UpdateRoomNumber(Request $request , $id){
        $room_number = RoomNumber::find($id);
        $room_number->romm_nb = $request->romm_nb;
        $room_number->status = $request->status;
        $room_number->save();

        $notification = array(
            'message' => 'Room Number Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }



    public function DeleteRoomNumber($id){

        RoomNumber::find($id)->delete();

        $notification = array(
            'message' => 'Room Number Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    // ---------------------------------------------------------------

    public function DeleteRoom($id){
        $room = Room::find($id);

        if (file_exists('upload/room/'.$room->image) AND ! empty($room->image)){
            @unlink('upload/room/'.$room->image);
        }

        $subimage = MultiImage::where('rooms_id',$room->id)->get()->toArray();
        if (!empty($subimage)) {
            foreach ($subimage as $value) {
               if (!empty($value)) {
               @unlink('upload/room/multi_img/'.$value['multi_img']);
               }
            }
        }


        RoomType::where('id',$room->roomtype_id)->delete();
        MultiImage::where('rooms_id',$room->id)->delete();
        Facility::where('rooms_id',$room->id)->delete();
        RoomNumber::where('rooms_id',$room->id)->delete();
        $room->delete();

        $notification = array(
            'message' => 'Room Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  


    }


}