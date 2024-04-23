<?php

namespace app\common\model\nav;

use app\common\model\TimeModel;

class CommentBaseModel extends TimeModel
{
    protected $name = "nav_comment";

    protected $createTime = 'create_time';

    protected $deleteTime = "delete_time";

}