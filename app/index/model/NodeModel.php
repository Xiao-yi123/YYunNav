<?php

namespace app\index\model;

use app\common\model\nav\NodeBaseModel;

class NodeModel extends NodeBaseModel
{
    /**
     * 获取所有节点
     * @return Node|array|Collection
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function FgetAllNodes($field = "",$is_link = false){
        $reqult = $this->where([
            'status'=>1,
            'pid'  =>0
        ])->field($field)->select();
        foreach ($reqult as $key => $value){
            $two_data = $this->where([
                'status'=>1,
                'pid'  =>$value['id']
            ])->field($field)->select();
            $reqult[$key]['two_data'] = $two_data;
        }

        if($is_link){
            $reqult = $this->FgetAllNodeToAllLink($reqult,['id','name','description','url','image_path']);
        }
        return $reqult;
    }

    /**
     * 根据节点获取链接
     * @return Node|array|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function FgetAllNodeToAllLink($AllNode,$field = ""){
        foreach ($AllNode as $OneNavKey=>$OneNavValue){
//            有子节点
            if($AllNode[$OneNavKey]["two_data"] != "[]"){
                $AllNode[$OneNavKey]['link_data'] = LinksModel::where("node_id",$OneNavValue['two_data'][0]['id'])->field($field)->select();
                $AllNode[$OneNavKey]['display_type'] = $OneNavValue['two_data'][0]['display_type'];
            }else{
                $AllNode[$OneNavKey]['link_data'] = LinksModel::where("node_id",$OneNavValue['id'])->field($field)->select();
            }
        }
        return $AllNode;
    }
}