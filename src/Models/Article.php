<?php

namespace WireContent\Models;

use App\ArticleStatus;
use App\Models\Category;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use WireComments\Traits\Commentable;

class Article extends Model
{
    use Commentable, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'media_id',
        'user_id',
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }
}
