<?php

namespace WireContent\Models;

use App\ArticleStatus;
use App\Models\Category;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use WireComments\Traits\Commentable;
use Illuminate\Support\Str;

class Article extends Model
{
    use Commentable, SoftDeletes, HasSEO;

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

    public function getDynamicSEOData(): SEOData
    {
        $this->loadMissing('image');
        $pathToFeaturedImageRelativeToPublicPath = (string)$this->image?->url;

        return new SEOData(
            title: $this->title,
            description: tiptap_converter()->asText(Str::limit($this->content, 160)),
            image: $pathToFeaturedImageRelativeToPublicPath ?? 'media/placeholder.png',
        );
    }
}
