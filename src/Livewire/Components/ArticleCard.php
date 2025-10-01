<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;
use WireContent\Models\Article;

class ArticleCard extends Component
{
    public Article $article;

    public function render(): View
    {
        return view('livewire.components.article-card');
    }
}
