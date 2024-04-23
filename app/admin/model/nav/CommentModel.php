<?php

namespace app\admin\model\nav;

use app\common\model\nav\CommentBaseModel;
class CommentModel extends CommentBaseModel
{

    protected $name = "nav_comment";

    protected $deleteTime = "delete_time";
    
    public function getStatusList()
    {
        return ['0'=>'不展示','1'=>'展示',];
    }

}