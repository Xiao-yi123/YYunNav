<?php
namespace app\index\controller;

use app\common\constants\IndexBase;
use app\index\model\BulletinModel;
use app\index\service\IndexService;
use think\Request;

class Bulletin extends IndexBase
{
    public function index(Request $request)
    {
        $MBulletin = new BulletinModel();

        if($request->isGet()){
            $bulletinID = $request->get('id');

            $SIndex = new IndexService();
            $SIndex->GetUniversalData();

            $data = $MBulletin->withJoin("systemadmin","LEFT")
                                ->where("ea_nav_bulletin.id",$bulletinID)
                                ->find()
                                ->toArray();
            $left = $MBulletin->where("create_time","<",strtotime($data['create_time']))
                                ->where("status",1)
                                ->field(['title','id'])
                                ->find();
            $right = $MBulletin->where("create_time",">",strtotime($data['create_time']))
                ->where("status",1)
                ->field(['title','id'])
                ->find();
            $bulletin = [
                'id'    =>$data['systemadmin']['id'],
                'title'   =>  $data['title'],
                'content'   =>  $data['content'],
                'username'   =>  $data['systemadmin']['username'],
                "time"      =>  date('Y-m-d',strtotime($data['create_time']))
            ];
            $pagination  =  [
                'left'  =>  $left,
                'right' =>  $right
            ];
            $this->assign('bulletin',$bulletin);
            $this->assign('pagination',$pagination);

            return  $this->fetch();
        }

    }

    public function all(Request $request){
        $MBulletin = new BulletinModel();
        if($request->isGet()){
            $SIndex = new IndexService();
            $SIndex->GetUniversalData();

            $data = $MBulletin->withJoin("systemadmin","LEFT")
                ->where("ea_nav_bulletin.status",1)
                ->order(['create_time'=>'desc'])
                ->select()
                ->toArray();
            $bulletins = [
                'conunt'    =>count($data),
                'top'   =>  [],
                'no_top'    =>  []
            ];
            foreach($data as $vo){
                $bulletin = [
                    'id'    =>$vo['systemadmin']['id'],
                    'title'   =>  $vo['title'],
                    'content'   =>  $vo['content'],
                    "time"      =>  date('Y-m-d',strtotime($vo['create_time']))
                ];
                if($vo['top'] == 1){
                    $bulletins['top'][] = $bulletin;
                }else{
                    $bulletins['no_top'][] = $bulletin;
                }
            }
            $this->assign('bulletin',$bulletins);

            return  $this->fetch('bulletin/index');

        }
    }


}
