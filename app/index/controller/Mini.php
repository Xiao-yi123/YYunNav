<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\constants\IndexBase;
use app\index\model\LinksModel;
use app\index\service\IndexService;

class Mini extends IndexBase
{
    /**
     * 显示资源列表
     *
     * @return string|\think\Response
     */
    public function index()
    {
        $this->app->view->engine()->layout(false);

        $IndexS = new IndexService();
        $IndexS->GetMiniData();

        $MLink = new LinksModel();
        $SiteData = $MLink->where('status',0)->limit(12)->orderRaw("rand(),id DESC")->select()->toArray();

        $this->assign("SiteDate",$SiteData);

        return $this->fetch();
    }


}
