<?php

namespace App\Repositories\Base;

abstract class CustomRepository
{
    protected $_sortField = 'id';
    protected $_sortType = 'DESC';
    protected $_queryParams = [];
    protected $_limit = 20;

    public function __construct()
    {
        //$this->validator ? $this->validator = $this->getValidator()->setModel($this->getModel()) : null;
    }

    public function getQueryParams()
    {
        return $this->_queryParams;
    }

    public function setQueryParams($queryParams)
    {
        $this->_queryParams = $queryParams;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    // Specify Model class name
    function model()
    {
        return "";
    }

    public function getValidator()
    {
        return $this->validator;
    }
}