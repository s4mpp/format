<?php

namespace S4mpp\Format\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \S4mpp\Format\Skeleton\SkeletonClass
 */
class Format extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'format';
    }
}
