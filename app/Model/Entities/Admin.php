<?php

namespace App\Model\Entities;
use App\Model\Presenters\AdminPresenters;
use App\Model\Base\AuthLaravel;

class Admin extends AuthLaravel
{
    use AdminPresenters;

    protected $_table = 'admins';
    protected $_alias = 'admins';
    protected $_primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role_type','ins_id', 'upd_id', 'ins_datetime', 'upd_datetime', 'del_flag'
    ];

    // Accessor
    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    // Mutator
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}