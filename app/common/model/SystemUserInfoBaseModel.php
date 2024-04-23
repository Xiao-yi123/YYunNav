<?php
declare (strict_types = 1);

namespace app\common\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class SystemUserInfoBaseModel extends TimeModel
{
    protected $name = "system_user_info";

    protected $deleteTime = "delete_time";

}
