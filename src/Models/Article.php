<?php

namespace WireContent\Models;

use App\ArticleStatus;
use App\Models\Category;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use WireComments\Traits\Commentable;

class Article extends Model
{
    use Commentable, HasSEO, SoftDeletes;

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

    public function scopeIsPublished(Builder $query): Builder
    {
        return $query->where('status', ArticleStatus::PUBLISHED);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function getDynamicSEOData(): SEOData
    {

        return new SEOData(
            title: $this->title,
            description: tiptap_converter()->asText(Str::limit($this->content, 160)),
            image: $this->image?->url,
        );
    }
}
