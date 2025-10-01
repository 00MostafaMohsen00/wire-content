<?php

namespace WireContent\Enums;

use Illuminate\Support\Str;

enum ArticleStatus: string
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }

    public static function options()
    {
        return collect(self::cases())->mapWithKeys(fn($status) => [$status->value => Str::title($status->name)]);
    }
}
