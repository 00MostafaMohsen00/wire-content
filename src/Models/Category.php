<?php

namespace WireContent\Models;

use App\Models\Product;
use App\Models\User;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use WireContent\Models\Article;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasSEO;
    use Searchable;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'media_id',
        'user_id',
        'text_color',
        'background_color',
        'is_tag',
        'parent_id',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_category');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: Str::limit(tiptap_converter()->asText($this->content), 100),
            image: $this->image?->url,
        );
    }
}
