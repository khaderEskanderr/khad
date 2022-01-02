<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $fillable = ['name', 'viewers'];
    public $timestamps = false;



    public function product_id()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
    public function user_id()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
