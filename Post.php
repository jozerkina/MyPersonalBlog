<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    public function blog() {
        return $this->belongsTo('App\Blog');
    }
    public function comments() {
        return $this->hasMany('App\Comment');     
    }
    public function keywords() {
        return $this->hasMany('App\Keyword');     
    }
    
    public static function deleteData($id){
        DB::table('posts')->where('id', '=', $id)->delete();
    }
}
