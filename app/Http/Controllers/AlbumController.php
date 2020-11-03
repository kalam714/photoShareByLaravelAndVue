<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Album;

class AlbumController extends Controller
{
   public function create(){
       return view('album.create');
   }
   public function store(Request $request){
       $validateData=$request->validate([
           'name'=>'required',
           'description' =>'required',
           'category_id'=>'required',
           'image'=>'required'

       ]);
       $imageName=$request->image->hashName();
       $request->image->move(public_path('album'),$imageName);
       $album=Album::create([
        'name'=>$request->name,
        'description'=>$request->description,
        'category_id'=>$request->category_id,
        'slug'=>Str::slug($request->name),
        'user_id'=>auth()->user()->id,
        'image'=>$imageName
]);
        $id=$album->id;
         return response()->json(['id'=>$id]);

   }
   public function index(){
       return view('album.index');
   }
   public function getAlbums(){
       $albums=Album::with('category')->where('user_id',auth()->user()->id)->get();
       return $albums;
   }
   public function getAlbum($id){
       return Album::with('category')->find($id);
   }
   public function updateAlbum(Request $request,$id){
       $findAlbum=Album::find($id);
       $photo=$findAlbum->image;
       if($request->hasFile('image')){
           $file=$request->file('image');
           $photo=$file->hashName();
           $file->move('./album/',$photo);
       }
       $album=Album::find($id);
       $album->name=$request->name;
       $album->description=$request->description;
       $album->category_id=$request->category_id;
       $album->image=$photo;
       $update=$album->save();
       if($update){
           return response()->json($this->getAlbums());
       }
   }
   public function deleteAlbum($id){
       $album=Album::find($id)->delete();
       if($album){
        return response()->json($this->getAlbums());
    }

   }
}
