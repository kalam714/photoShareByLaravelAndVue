<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Album;
use App\Models\User;

class GalleryController extends Controller
{
    public function createImage($id){
        $albumUser=Album::where('user_id',auth()->user()->id)->where('id',$id)->exists();
        if($albumUser){
            $album_id=$id;
            session()->put('id',$id);
            return view('image.create',compact('album_id'));
        }else{
            return redirect()->back();
        }
       
    }
    public function uploadImage(Request $request){
       foreach($request->file('files')  as $file){
           $name=$file->hashName();
           $file->move(public_path().'/images/',$name);
           $file=new Photo;
           $file->album_id=$request->album_id;
           $file->image=$name;
           $file->save();
       }
       return response()->json(['success'=>'Image Uplaoded']);
    }
    public function getImages(){
        return Photo::where('album_id',session()->get('id'))->get();
    }
    public function deleteImage($id){
        $image=Photo::find($id);
        $image->delete();
    }
    public function viewAlbumImages($slug,$id){
        $albums=Album::with('allAlbumImages')->where('slug',$slug)->where('id',$id)->get();
        if(\Auth::check()){
        $userId=Album::where('id',$id)->first()->user_id;
        $follows=new User();
        $follows->isFollowing($userId);
        return view('album.show',compact('albums','userId','follows'));
        }else{
            return view('album.show',compact('albums'));
        }
     
        
    }
}
  