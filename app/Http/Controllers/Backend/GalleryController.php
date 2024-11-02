<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function AllGallery(){
        $gallery = Gallery::latest()->get();
        return view('backend.gallery.all_gallery', compact('gallery'));
    }

    public function AddGallery(){
        return view('backend.gallery.add_gallery');
    } // End Method 


    public function StoreGallery(Request $request){
        $images = $request->file('photo_name');
        
        foreach ($images as $img) {
        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        $img->move('upload/Gallery/',$name_gen);
       
        Gallery::insert([
            'photo_name' => $name_gen,
            'created_at' => Carbon::now(), 
        ]);
        } //  end foreach 
        $notification = array(
            'message' => 'Gallery Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.gallery')->with($notification);
    }// End Method 


    public function EditGallery($id){

        $gallery = Gallery::find($id);
        return view('backend.gallery.edit_gallery',compact('gallery'));
    }// End Method 


    public function UpdateGallery(Request $request){
        $gal_id = $request->id;
        $data = Gallery::find($gal_id);

        $file = $request->file('photo_name');
        @unlink(public_path('upload/Gallery/'.$data->photo_name)); // no duplicate images just upload one
        $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension(); 
        $file->move(public_path('upload/Gallery/'), $filename);

        Gallery::find($gal_id)->update([
            'photo_name' => $filename, 
        ]); 
        $notification = array(
            'message' => 'Gallery Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.gallery')->with($notification);  
    }// End Method 

    public function DeleteGallery($id){
        $item = Gallery::findOrFail($id);
        $img = $item->photo_name;
        @unlink('upload/Gallery/'.$img);
        Gallery::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Gallery Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

     }   // End Method 



     public function DeleteGalleryMultiple(Request $request){
        $selectedItems = $request->input('selectedItem', []);
        foreach ($selectedItems as $itemId) {
           $item = Gallery::find($itemId);
           $img = $item->photo_name;
           @unlink('upload/Gallery/'.$img);
           $item->delete();
        }
        $notification = array(
            'message' => 'Selected Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }// End Method 

    public function ShowGallery(){
        $gallery = Gallery::latest()->get();
        return view('frontend.gallery.show_gallery', compact('gallery'));
    }



}
