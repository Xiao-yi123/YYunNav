<?php
namespace app\common\constants;

use app\BaseController;
use think\facade\View;

//暂时无用

/**
 * index应用控制器基类
 */
class IndexBase extends BaseController
{
    use \app\index\traits\AjaxTrait;
    /**
     * 模板布局, false取消
     * @var string|bool
     */
    protected $layout = 'layout/IndexLayout';

    //页面渲染
    protected function assign($name = '',$value = [])
    {
        return View::assign($name,$value);
    }
    //初始化
    public function initialize()
    {
        $this->layout && $this->app->view->engine()->layout($this->layout);
    }

}
