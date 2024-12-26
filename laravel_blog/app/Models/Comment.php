<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    static public $statuses = [
        'moderating' => [
            'value' => 10,
            'name' => 'на модерации',
        ],
        'published' => [
            'value' => 20,
            'name' => 'опубликован',
        ],
        'canceled' => [
            'value' => 30,
            'name' => 'заблокирован',
        ]
    ];

    protected $fillable = [
        'post_id',
        'user',
        'text',
        'status'
    ];

    // protected $hidden = [
    //     'updated_at',
    //     'deleted_at',
    //     'post_id'
    // ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function status()
    {
        return $this->belongsTo(CommentStatus::class);
    }

    public function scopePublished($query)
    {
        // $query->where('status', 20);
        $query->where([
            ['status', '<>', (string)(Comment::$statuses['canceled']['value'])]
        ]);
    }
}
