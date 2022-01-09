<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title','price','description','image','cat_id','stock'];


    public function category()
    {
      return $this->belongsTo(Category::class,'cat_id','id');
    }
}
