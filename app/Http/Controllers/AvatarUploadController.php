<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
  
class AvatarUploadController extends Controller
{
    public function avatarUpload()
    {
        return view('avatarUpload');
    }

    public function avatarUploadPost(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $avatarName = time().'.'.$request->avatar->extension();  
     
        $request->avatar->move(public_path('img'), $avatarName);

        $user = Auth::user();
        $user->avatar = $avatarName;
        $user->save();
  
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$avatarName); 
    }
}