<?php
declare (strict_types = 1);

namespace app\admin\validate;

use app\admin\service\define\Base64Service;
use think\Validate;

class LinkValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        "name"  =>  'require|max:50|min:2',
        "description"   =>  "max:255",
        "url"   =>  "require",
        'image_base64'  =>  'CheckBase64Image'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'name.max'  =>  "资源名长度不能超过50",
        'name.min'  =>  "资源名长度不能少于2",
        'description.max'  =>  "资源描述长度不能超过255",
        'image_base64.CheckBase64Image'  =>  '资源图片数据不正确'
    ];



    /**
     * 判断Base64数据是否是图片
     * @param string $value 验证内容
     * @param string $rule 验证规则
     * @param $data
     * @param string $field 验证的字段名
     * @return bool
     */
    public function CheckBase64Image($value, $rule, $data=[], $field){
        $Base64S = new Base64Service();
        return (bool)$Base64S->isBase64Image($value);
    }

}
