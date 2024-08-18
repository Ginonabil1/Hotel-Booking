<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Carbon\Carbon;


class TeamController extends Controller
{
    public function AllTeam(){
        $team = Team::latest()->get();
        return view('backend.team.all_team',compact('team'));
    }

    public function AddTeam(){
        return view('backend.team.add_team');
    }


    public function TeamStore(Request $request){
        
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();  
            $file->move(public_path('upload/team'), $filename);
            
            // Insert a new team record with the uploaded image
            Team::insert([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $filename, // Use the uploaded image filename
                'created_at' => Carbon::now(),
            ]);
        }
        

        $notification = array(
            'message' => 'Team Data Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.team')->with($notification);
    }

    
    public function TeamEdit($id){
        $team = Team::findorfail($id);
        return view('backend.team.edit_team',compact('team'));
    }



    public function TeamUpdate(Request $request){

        $team_id = $request->id;
        $data = Team::find($team_id);

        if($request->file('image')){

            $file = $request->file('image');
            @unlink(public_path('upload/team/'.$data->image)); // no duplicate images just upload one
            $filename = date('YmdHi') . $file->getClientOriginalName();  
            $file->move(public_path('upload/team'), $filename);

            Team::findOrFail($team_id)->update([

                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $filename,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Team Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.team')->with($notification);


        } else {

            Team::findOrFail($team_id)->update([

                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook, 
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Team Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.team')->with($notification);

        } // End Eles 
    }

    public function TeamDelete($id){

        $item = Team::findorFail($id);
        $img = $item->image;
        @unlink(public_path('upload/team/'.$img)); // no duplicate images just upload one
        $item->delete();

        $notification = array(
            'message' => 'Team Member Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

}