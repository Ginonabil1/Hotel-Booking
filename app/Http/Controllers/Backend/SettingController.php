<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmtpSetting;
use App\Models\SiteSetting;


class SettingController extends Controller
{
    public function SmtpSetting(){

        $smtp = SmtpSetting::find(1);
        return view('backend.setting.smpt_update',compact('smtp'));

    }// End Method 


    public function SmtpUpdate(Request $request){

        $smtp_id = $request->id;

        SmtpSetting::find($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);

        $notification = array(
            'message' => 'Smtp Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  
    }// End Method 


    // Site setting

    public function SiteSetting(){

        $site = SiteSetting::find(1);
        return view('backend.setting.site_update',compact('site'));

    }// End Method 


    public function SiteUpdate(Request $request){

        $site_id = $request->id;
        $data = SiteSetting::find($site_id);

        if($request->file('logo')){
            $file = $request->file('logo');
            @unlink(public_path('upload/Logo/'.$data->logo)); // no duplicate images just upload one
            $filename = date('YmdHi') . $file->getClientOriginalName();  
            $file->move(public_path('upload/Logo'), $filename);
    
            SiteSetting::find($site_id)->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'copyright' => $request->copyright,
                'logo' => $filename,
            ]);
    
            $notification = array(
                'message' => 'Logo Updated With Image Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        } else {
            SiteSetting::find($site_id)->update([
    
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'copyright' => $request->copyright,
                ]);
        
                $notification = array(
                    'message' => 'Site Setting Updated Without Image Successfully',
                    'alert-type' => 'success'
                );
        
                return redirect()->back()->with($notification);
        } // End Eles  

    }// End Method 


}
