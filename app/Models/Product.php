<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $keyType = 'id';
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'user_id',
        'image_url',
        'product_offer',
        'prices',
        'quantity',
        'cate_id',
        'description',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
