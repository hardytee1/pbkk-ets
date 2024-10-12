<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'caption',
        'image_path',
        'like_count',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
