<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Photo;
use App\Models\User;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'user_id',
        'slug',
        'category_id'
    ];
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function allAlbumImages(){
        return $this->hasMany(Photo::class,'album_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
