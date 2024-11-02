<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Carbon\Carbon;

class TestimonialController extends Controller
{
    public function AllTestimonial(){
        $testimonial = Testimonial::latest()->get();
        return view('backend.tesimonial.all_tesimonial',compact('testimonial'));
    } // End Method 


    public function AddTestimonial(){
        return view('backend.tesimonial.add_testimonial');
    }// End Method 


    public function StoreTestimonial(Request $request){
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();  
            $file->move(public_path('upload/Testimonial'), $filename);
            
            // Insert a new team record with the uploaded image
            Testimonial::insert([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'image' => $filename,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Testimonial Data Inserted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.testimonial')->with($notification);
    

        }
    } // End Method 


    public function EditTestimonial($id){
        $testimonial = Testimonial::find($id);
        return view('backend.tesimonial.edit_testimonial',compact('testimonial'));
    } // End Method 


    public function UpdateTestimonial(Request $request){
        $testimonial = $request->id;
        $data = Testimonial::find($testimonial);

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/Testimonial/'.$data->image)); // no duplicate images just upload one
            $filename = date('YmdHi') . $file->getClientOriginalName();  
            $file->move(public_path('upload/Testimonial'), $filename);
    
            Testimonial::findOrFail($testimonial)->update([
    
            'name' => $request->name,
            'city' => $request->city,
            'message' => $request->message,
            'image' => $filename,
            'created_at' => Carbon::now(),
            ]);
    
            $notification = array(
                'message' => 'Testimonial Updated With Image Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.testimonial')->with($notification);
        } else {
            Testimonial::findOrFail($testimonial)->update([
    
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message, 
                'created_at' => Carbon::now(),
                ]);
        
                $notification = array(
                    'message' => 'Testimonial Updated Without Image Successfully',
                    'alert-type' => 'success'
                );
        
                return redirect()->route('all.testimonial')->with($notification);
        } // End Eles  


    }// End Method 

    public function DeleteTestimonial($id){
        $item = Testimonial::findOrFail($id);
        $img = $item->image;
        @unlink(public_path('upload/Testimonial/'.$img)); // no duplicate images just upload one
        $item->delete();
        
        $notification = array(
            'message' => 'Testimonial Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }   // End Method 


}
