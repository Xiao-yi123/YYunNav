<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\common\constants\IndexBase;

use app\index\model\BulletinModel;
use app\index\model\CommentModel;
use app\index\model\LinksModel;
use app\index\model\NodeModel;
use app\index\service\IndexService;
use app\Request;
use think\captcha\Captcha;

class Index extends IndexBase
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub

        $this->MNode = new NodeModel();
        $this->MLink = new LinksModel();
        $this->MComment = new CommentModel();
        $this->MBulletin = new BulletinModel();
    }

    /**
     * 首页
     * @param Request $request
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index(Request $request)
    {
        $SIndex = new IndexService();
        $SIndex->GetUniversalData();

        $ContentLink = $this->MNode->FgetAllNodes(['id','name','display_type'],true);
        $Bulletin = $this->MBulletin->where("status",1)->field(['title','id'])->select();
        $friendlink = $this->MLink->where('node_id',0)->field(['name','url','description'])->select();

        $this->assign('ContentLink',$ContentLink);
        $this->assign('IsSSearch',true);
        $this->assign('Bulletin',$Bulletin);
        $this->assign('friendlink',$friendlink);
        return $this->fetch("");
    }


    /**
     * 跳转
     * @param Request $request
     * @return string|void
     */
    public function go(Request $request){
        if($request->isGet()){
            $this->app->view->engine()->layout(false);

            $url =$request->get('url');

            $url = encryptDecrypt("url",$url,1);

            $this->assign('url',$url);
            return $this->fetch("/index/go/index");
        }
    }

    /**
     * ajax请求
     * @param Request $request
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function ajax(Request $request){
        $this->app->view->engine()->layout(false);

        $reData = $request->param();

        if($request->isPost()&&$reData['action']=="load_home_tab") {
            $id = $reData['id'];
            $CurrentLinkCard = $this->MLink->where([
                "links_id"   =>  $id,
                "status"    =>  0
            ])->select()->toArray();

            $display_type = $this->MNode->where("id",$id)->find()['display_type'];
            $this->assign('display_type',$display_type);
            $this->assign('CurrentLinkCard',$CurrentLinkCard);
//            halt($CurrentLinkCard);
            return $this->fetch("index/ajax/load_home_tab");
        }
    }

}
