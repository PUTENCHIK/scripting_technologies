<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class CommentStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }

    public function scopeByName(Builder $query, string $name): void
    {
        $query->where('name', $name);
    }
}
