<?php

namespace App\Model\Presenters;

trait AdminPresenters
{
    public function isSuperAdmin()
    {
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
