<?php

namespace App\Model\Presenters\Base;

use Carbon\Carbon;

trait BasePresenters
{
    public function getCreatedAtValue($format = 'Y-m-d H:i:s')
    {
        if (!empty($this->getCreatedAtColumn())) {
            return Carbon::parse($this->{getCreatedAtColumn()})->format($format);
        }
        return null;
    }

    public function getUpdatedAtValue($format = 'Y-m-d H:i:s')
    {
        if(!empty($this->{getUpdatedAtColumn()})) {
            return Carbon::parse($this->{getUpdatedAtColumn()})->format($format);
        }
        return null;
    }
}