<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\constants\IndexBase;
use app\index\service\IndexService;
use think\Request;

class Disclaimer extends IndexBase
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        if($request->isGet()){
            $SIndex = new IndexService();
            $SIndex->GetUniversalData();

            return $this->fetch("");
        }

    }

}
