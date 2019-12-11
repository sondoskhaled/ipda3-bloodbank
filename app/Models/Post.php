<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'img', 'content', 'category_id');
    protected $appends = ['is_favourite'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function getIsFavouriteAttribute($v)
    {
        // query if favourite
        $check = Client::where('id',request()->user()->id)->whereHas('posts',function($q){
            $q->where('clientables.clientable_id',$this->id);
        })->first();

        if($check)
        {
            return true;
        }

        return false;
    }

}