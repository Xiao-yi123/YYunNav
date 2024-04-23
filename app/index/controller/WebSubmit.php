<?php

namespace app\index\controller;

use app\admin\service\define\ImageService;
use app\common\constants\IndexBase;
use app\index\model\LinksModel;
use app\index\model\NodeModel;
use app\index\service\IndexService;
use app\Request;

class WebSubmit extends IndexBase
{
    /**
     * 网站提交
     * @param Request $request
     * @return array|string|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index(Request $request){

        if($request->isGet()){
            $MNode = new NodeModel();
            $SIndex = new IndexService();
            $SIndex->GetUniversalData();

            $choose = $MNode->FgetAllNodes($field=['id','name']);
            $distinguish = [
                'source'    =>  "submit",
                'FirstPanelName'    =>  '网站提交',
                'icon'  =>  "icons8-推荐",
                "iconContent"  =>  "推荐资源"
            ];

            $this->assign('distinguish',$distinguish);
            $this->assign('choose',$choose);
            return $this->fetch("message_submit/index");
        }elseif ($request->isPost()){
            $Rdata = $request->param();
            if($Rdata['type'] == "sites"){
                if(!captcha_check($Rdata['image_captcha'])){
                    // 验证失败
                    $this->error('验证码错误');

                };
                //发送邮件--暂时没写
                $MLink = new LinksModel();
                $SImage = new ImageService();

                if(!$MLink->where("id",$Rdata['node_id'])->find()){
                    $this->warn("请选择标签分类");
                }
//                后面可以判断域名是否存在
                if($MLink->whereOr('name',$Rdata['name'])->whereOr("url",$Rdata['url'])->find()){
                    $this->warn("您提交的网站已存在！！！");
                }

                try{
                    $Rdata["status"] = 2;

                    $path = $MLink->getImagePath($Rdata['node_id']);
                    $Rdata['image_path'] = $SImage->DownloadImage($Rdata['url'],"random",$path);

                    $save = $MLink->save($Rdata);
                }catch (\Exception $e){
                    $this->error('提交失败：',$e->getMessage());
                }

                $save ? $this->success('提交成功') :$this->error('提交失败');
            }
        }
    }
}