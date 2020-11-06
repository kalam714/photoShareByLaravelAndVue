<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\User;

class IndexController extends Controller
{
    public function index(){
        $albums=Album::latest()->paginate(20);
        return view('home',compact('albums'));
    }
    public function userAlbums($id){
        $albums=Album::where('user_id',$id)->get();
        if(\Auth::check()){
        $userId=$id;
        $follows=(new User)->isFollowing($userId);
        $user=User::where('id',$id)->first();
        $coverpic = $user->coverPic;
        return view('userAlbum',compact('albums','userId','follows','coverpic'));
        }
       

        return view('userAlbum',compact('albums'));
    }
    public function userAlbumsByCategory($id){
       $albums=Album::where('category_id',$id)->get();
       return view('albumCategory',compact('albums'));
    }


}
