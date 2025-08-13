<?php

namespace WireContent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use WireComments\Traits\Commentable;

class Article extends Model
{
    use Commentable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'media_id',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }
}
