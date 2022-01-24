<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $table = 'videos';
    protected $fillable = [
        'user_id',
        'product_id',
        'value',
        'creat_up',
        'update_up'
    ];
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
