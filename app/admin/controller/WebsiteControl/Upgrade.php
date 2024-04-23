<?php
declare (strict_types = 1);

namespace app\admin\controller\WebsiteControl;

use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
/**
 * @ControllerAnnotation(title="升级控制")
 */
class Upgrade extends AdminController
{
    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if($this->request->isGet()){

            return $this->fetch();
        }
    }


}
