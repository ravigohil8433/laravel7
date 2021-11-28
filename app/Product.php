<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['name','description','category_id'];
    /**
     * Get the user that added the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
