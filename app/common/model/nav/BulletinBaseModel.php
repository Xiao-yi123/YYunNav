<?php
declare (strict_types = 1);

namespace app\common\model\nav;

use app\admin\model\SystemAdmin;
use app\common\model\TimeModel;
use think\Model;

/**
 * @mixin \think\Model
 */
class BulletinBaseModel extends TimeModel
{
    protected $name = "nav_bulletin";

    protected $createTime = 'create_time';

    protected $deleteTime = "delete_time";

    /**
     * 一对多关联 SystemAdmin 表
     * @return \think\model\relation\HasMany
     */
    public function systemAdmin(){
        return $this->belongsTo(SystemAdmin::class,"admin_id",'id');
    }
}
