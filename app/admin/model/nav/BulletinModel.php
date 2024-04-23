<?php

namespace app\admin\model\nav;

use app\common\model\nav\BulletinBaseModel;

class BulletinModel extends BulletinBaseModel
{

    protected $name = "nav_bulletin";

    protected $deleteTime = "delete_time";

    
    
    public function getTopList()
    {
        return ['0'=>'不置顶','1'=>'置顶',];
    }

    public function getStatusList()
    {
        return ['0'=>'隐藏','1'=>'展示',];
    }


}