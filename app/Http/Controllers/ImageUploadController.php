<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
  
class ImageUploadController extends Controller
{
    public function imageUpload()
    {
        return view('imageUpload');
    }

    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->avatar->extension();  
     
        $request->avatar->move(public_path('img'), $imageName);

        $user = Auth::user();
        $user->avatar = $avatarName;
        $user->save();
  
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}