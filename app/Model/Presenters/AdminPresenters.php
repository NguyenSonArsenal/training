<?php

namespace App\Model\Presenters;

use App\Model\Presenters\Base\BasePresenters;

trait AdminPresenters
{
    use BasePresenters;

    public function isSuperAdmin()
    {
        dd('Zo isSuperAdmin in admin presenter');
        if ($this->role_type) {
            return getConstant('SUPER_ADMIN_TYPE') == $this->role_type;
        }
        return false;
    }

    public function isAdmin()
    {
        if ($this->role_type) {
            return getConstant('ADMIN_TYPE') == $this->role_type;
        }
        return false;
    }
}
