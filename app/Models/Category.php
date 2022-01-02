<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $fillable = ['name'];
    public  $timestamps = false ;
    public function products()
    {
        return $this->hasMany('Product::class', 'category_id', 'id');
    }
}
