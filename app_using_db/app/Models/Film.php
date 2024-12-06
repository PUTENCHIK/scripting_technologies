<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Film extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'director_id',
        'year'
    ];

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function scopeBySlug(Builder $query, string $slug): void
    {
        $query->where('slug', $slug);
    }
}
