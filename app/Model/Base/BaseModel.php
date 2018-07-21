<?php
/**
 * Created by PhpStorm.
 * User: SON
 * Date: 7/21/2018
 * Time: 6:58 PM
 * Base common for all model
 */

namespace App\Model\Base;

use App\Model\Presenters\Base\BasePresenters;
use App\Model\Scope\Base\BaseScope;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use BasePresenters;
    use BaseScope;
}