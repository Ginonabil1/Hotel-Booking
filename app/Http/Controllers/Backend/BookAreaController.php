<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookArea;

class BookAreaController extends Controller
{
    public function BookArea(){
        $book = BookArea::find(1);

        return view('backend.bookarea.book_area',compact('book'));
    }


    public function BookAreaUpdate(Request $request){

        $book_id = $request->id;
        $data = BookArea::find($book_id);

        if($request->file('image')){

            $file = $request->file('image');
            @unlink(public_path('upload/BookArea/'.$data->image)); // no duplicate images just upload one
            $filename = date('YmdHi') . $file->getClientOriginalName();  
            $file->move(public_path('upload/BookArea'), $filename);

            BookArea::findOrFail($book_id)->update([

                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'description' => $request->description,
                'link' => $request->link,
                'image' => $filename,
            ]);

            $notification = array(
                'message' => 'BookArea Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);


        } else {

            BookArea::findOrFail($book_id)->update([

                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'description' => $request->description,
                'link' => $request->link,
            ]);

            $notification = array(
                'message' => 'BookArea Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
    }

    }
}
