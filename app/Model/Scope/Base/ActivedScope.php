<?php
/**
 * Created by PhpStorm.
 * User: SON
 * Date: 7/21/2018
 * Time: 10:45 PM
 */

namespace App\Model\Scope\Base;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ActivedScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        return $builder->where(getDelFlagColumn(), '=', getDelFlagColumn('active'))->orWhereNull(getDelFlagColumn());
    }
}