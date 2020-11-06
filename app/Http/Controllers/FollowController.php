<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;

class FollowController extends Controller
{
   public function followAndUnfollow(Request $request){
       $followerId=User::find(auth()->user()->id);
       $followingId=User::find($request->userId);
       $followerId->following()->toggle($followingId);
       return redirect()->back();

   }
   public function profile(){
       $followings=Follower::where('follower_id',auth()->user()->id)->get();
       foreach($followings as $following){
           $userId=$following->userfollow->id;
           $follows=(new User)->isFollowing($userId);
       }
       

       return view('profile',compact('userId','follows','followings'));
   }
   
   public function userProfilePicUpdate(Request $request){
       $image=$request->image->store('public/Dp');
       $user=User::where('id',auth()->user()->id)->update(['dp'=>$image]);
       return redirect()->back();

   }
   public function userProfilePic($id){
    $user=User::find($id);
     return $user->dp;

}
   public function userCoverPic($id){
       $user=User::find($id);
       return $user->coverPic;
   }
   public function userCoverPicUpdate(Request $request){
    $image=$request->image->store('public/coverpic');
    $user=User::where('id',auth()->user()->id)->update(['coverPic'=>$image]);
    return redirect()->back();

   }
}
