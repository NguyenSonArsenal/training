<?php
/**
 * Created by PhpStorm.
 * User: SON
 * Date: 7/19/2018
 * Time: 5:46 AM
 */

return [
    'created_at_column' => ['field' => 'ins_datetime'],
    'updated_at_column' => ['field' => 'upd_datetime'],
    'deleted_at_column' => [],
    'del_flag_column' => ['field' => 'del_flag', 'active' => 0, 'deleted' => 1],
    'created_by_column' => ['field' => 'ins_id'],
    'updated_by_column' => ['field' => 'upd_id'],
];