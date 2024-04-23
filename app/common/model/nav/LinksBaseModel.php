<?php

namespace app\common\model\nav;

use app\common\model\TimeModel;

class LinksBaseModel extends TimeModel
{

    protected $name = "nav_links";

    protected $updateTime = '';

    protected $deleteTime = "delete_time";

    public function getStatusList()
    {
        return ['0'=>'展示','1'=>'不展示','2'=>'审核中','3'=>'类-不展示','4'=>"链接不可用"];
    }

    public function navNode(){
        return $this->belongsTo(NodeBaseModel::class,"node_id",'id');
    }

    /**获取图片路径
     * @param $links_id  links表的id
     * @param $node_id  node表的id
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getImagePath($links_id = 0,$node_id = 0){
        if($links_id)
            $nodeName = $this->withJoin('nav_node','LEFT')
                ->where("ea_nav_links.id",$links_id)
                ->find()['navNode__name'];
        elseif($node_id)
            $nodeName = $this->navNode()->where('id',$node_id)
                ->find()['name'];
        else{
            $nodeName = '友链';
        }
        $ImageSavePath = "/static/image/urlimage/".$nodeName."/";
        return $ImageSavePath;
    }
}