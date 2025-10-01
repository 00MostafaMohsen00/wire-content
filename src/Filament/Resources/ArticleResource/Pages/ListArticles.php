<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\ArticleStatus;
use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Posts'),
            'published' => Tab::make('Published')->modifyQueryUsing(function ($query) {
                $query->where('status', ArticleStatus::PUBLISHED);
            }),
            'draft' => Tab::make('Draft')->modifyQueryUsing(function ($query) {
                $query->where('status', ArticleStatus::DRAFT);
            }),
        ];
    }
}
