<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Director extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['full_name', 'slug'];

    public function films() {
        return $this->hasMany(Film::class);
    }

    public function scopeBySlug(Builder $query, string $slug): void
    {
        $query->where('slug', $slug);
    }
}
