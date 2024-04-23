<?php

namespace app\common\model\nav;

use app\common\model\TimeModel;

class NodeBaseModel extends TimeModel
{
    protected $name = "nav_node";

    protected $deleteTime = "delete_time";
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

    /**
     * 一对多关联 Link 表
     * @return \think\model\relation\HasMany
     */
    public function navLinks(){
        return $this->hasMany(LinksBaseModel::class,"node_id",'id');
    }

    public function getStatusList()
    {
        return ['0'=>'不展示','1'=>'展示'];
    }

    public function getDisplayTypeList()
    {
        return ['1'=>'default','2'=>'mini','3'=>'book','4'=>'app'];
    }


    /**判断此节点下是否存在子节点
     * @param $id  node表的ID
     * @return bool
     */
    public function IsChildNode($node_id){
        $CurrentNode = $this->whereIn('id',$node_id)->find();
        if($CurrentNode['pid'] == 0){
            $TwoNodes = $this->whereIn('pid',$node_id)->where("status",1)->find();

            if($TwoNodes){
                return true;
            }
        }

        return false;

    }

    /**获取父节点的状态  如果没有父节点返回 true
     * @param $node_id node表的ID
     * @return mixed|true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getParentNodeStatus($node_id){
        $CurrentNode = $this->where('id',$node_id)->find()->toArray();
        if($CurrentNode['pid'] != 0){
            $status = $this->where('id',$CurrentNode['pid'])->field('status')->find()['status'];

            return $status;
        }
        return true;
    }

}