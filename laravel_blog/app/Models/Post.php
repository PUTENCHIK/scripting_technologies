<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'text',
        'path'
    ];

    public function comments()
    {
        return $this->all_comments()->published();
    }

    public function all_comments()
    {
        return $this->hasMany(Comment::class);
    }
}
