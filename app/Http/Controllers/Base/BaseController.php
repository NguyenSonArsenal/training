<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $_repository = null;

    public function __construct()
    {
    }

    public function getRepository()
    {
        return $this->_repository;
    }

    public function setRepository($repository)
    {
        $this->_repository = $repository;
        $this->setModel($repository->getModel());
        return $this;
    }
}