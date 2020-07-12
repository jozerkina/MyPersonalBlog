<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    public function posts() {
        return $this->hasMany('App\Post');     
    }
    
    public static function deleteData($id){
        DB::table('blogs')->where('id', '=', $id)->delete();
    } 
    
    public static function updateData($id, $data){
        DB::table('blogs')
            ->where('id', $id)
            ->update($data);
    }
}
