<?php

namespace App\Filament\Resources;

use App\ArticleStatus;
use App\Filament\Resources\ArticleResource\Pages;
use App\Forms\Components\Slug;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use RalphJSmit\Filament\SEO\SEO;
use WireContent\Models\Article;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->schema([
                    Tab::make('Content')->schema([
                        TextInput::make('title')->minLength(2),
                        Slug::make('slug')->required()->maxLength(5),
                        TiptapEditor::make('content')->required()->output(TiptapOutput::Json),
                        Select::make('category')
                            ->relationship('categories', 'title')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        Hidden::make('user_id')->dehydrateStateUsing(function ($state) {
                            return auth()->id();
                        }),
                        Select::make('status')->options(ArticleStatus::options()),
                    ]),

                    Tab::make('SEO')->schema([
                        SEO::make(),
                    ]),

                    Tab::make('Media')->schema([
                        CuratorPicker::make('media_id'),
                    ]),
                ]),

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('media_id')->label('Thumbnail')->size(40)->height(40),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('slug')->searchable()->sortable(),
                SelectColumn::make('status')->options(ArticleStatus::options())->searchable()->sortable(),
                TextColumn::make('categories.title')
                    ->label('Categories')
                    ->badge()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('categories')
                    ->multiple()
                    ->searchable()
                    ->relationship('categories', 'title'),
                TrashedFilter::make(),
                SelectFilter::make('status')->options(ArticleStatus::options()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
