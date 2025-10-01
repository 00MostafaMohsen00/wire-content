<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class CarouselBlock extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('carousel')
            ->schema([
                Repeater::make('images')
                    ->schema([
                        TextInput::make('title')->required(),
                        TiptapEditor::make('description')
                            ->label('Description')
                            ->output(TiptapOutput::Json),
                        FileUpload::make('image')->required()->image()->imageEditor(),
                    ]),
            ]);
    }


    public static function mutateData(array $data): array
    {
        return $data;
    }
}
