<?php

namespace App\Repositories;

use App\Repositories\Base\CustomRepository;
use App\Model\Entities\Admin;
/**
 * Class KeywordRepository
 * @package App\Repositories
 */
class AdminRepository extends CustomRepository
{
    /**
     * @return string
     */
    function model()
    {
        return Admin::class;
    }

    /**
     * @return string
     */
    public function validator()
    {
        return \App\Validators\Admin::class;
    }

    public function getListAdmins()
    {
        dd(Admin::all());
    }

}
