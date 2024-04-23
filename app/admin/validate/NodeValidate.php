<?php
declare (strict_types = 1);

namespace app\admin\validate;

use think\Validate;

class NodeValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        "name"  =>  'require|max:8|min:2',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'name.max'  =>  "链接名长度不能超过8",
        'name.min'  =>  "链接名长度不能少于2",
    ];

}
