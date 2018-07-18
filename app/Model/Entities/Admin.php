<?php

namespace App\Model\Entities;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $_table = 'admins';
    protected $_alias = 'admins';
    protected $_primaryKey = 'id';
}