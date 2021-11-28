<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['title','parent_id'];
    
    public function subcategory(){
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function childrenRecursive() {
        return $this->subcategory()->with('childrenRecursive');
    }
}
