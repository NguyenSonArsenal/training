<?php
/**
 * Created by PhpStorm.
 * User: SON
 * Date: 7/21/2018
 * Time: 6:17 PM
 * Apply the scope to all queries
 */

namespace App\Model\Scope\Base;

trait BaseScope
{
    /**
     * Boot the base scope trait for all model
     * Note: name function bootBaseCope = boot + name trait
     * @return void
     */
    public static function bootBaseScope()
    {
        static::addGlobalScope(new ActivedScope);
    }
}