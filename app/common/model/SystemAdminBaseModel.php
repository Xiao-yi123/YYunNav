<?php
declare (strict_types = 1);

namespace app\common\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class SystemAdminBaseModel extends TimeModel
{
    protected $name = "system_admin";

    protected $deleteTime = 'delete_time';

    public function systemUserInfo(){
        return $this->hasOne(SystemUserInfoBaseModel::class,'username','username');
    }

}
