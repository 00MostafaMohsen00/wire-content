<?php

namespace WireContent\Facades;

use Illuminate\Support\Facades\Facade;
use WireContent\WireContentServiceProvider;

/**
 * @see \VendorName\Skeleton\Skeleton
 */
class WireContent extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WireContentServiceProvider::class;
    }
}
