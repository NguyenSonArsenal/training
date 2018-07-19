<?php

namespace App\Model\Entities;
use App\Model\Presenters\AdminPresenters;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use AdminPresenters;

    protected $_table = 'admins';
    protected $_alias = 'admins';
    protected $_primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role_type','ins_id', 'upd_id', 'ins_datetime', 'upd_datetime', 'del_flag'
    ];

}