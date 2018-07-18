<?php

namespace App\Repositories\Base;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Container\Container as Application;

abstract class CustomRepository extends BaseRepository
{
    protected $_sortField = 'id';
    protected $_sortType = 'DESC';
    protected $_queryParams = [];
    protected $_limit = 20;

    public function __construct(Application $app)
    {
        parent::__construct($app);
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